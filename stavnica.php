<html>
<head>
  <title>Stavnica</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<body style="background-color:#d1eef9">
<table id="tekme">
<tr>
  <th>ID</th>
  <th>Domači</th>
  <th>Gosti</th>
  <th colspan="2">Rezultat</th>
  <th>Status</th>
  <th>1</th>
  <th>X</th>
  <th>2</th>
</tr>

 <?php
 include("prijavaPHP.php");
 include("povezavaBaza.php");
 $lige = array("PD","EPL","A","BL","L1","RFPL","PL","PR","1A","SL","BL","ERD","SL","SL","SL",
 "1.HNL","D1","D1","EK","AL","SL","1L","ED","SPL");
 $drzave = array("Spain","England","Italy","Germany","France","Russia","Portugal","Ukraine","Belgium","Turkey","Austria","Netherlands","Greece","Switzerland","Denmark","Croatia","Cyprus","Israel","Poland","Sweden","Serbia","Slovenia","Norway","Scotland");
 $ime = $_SESSION['uprIme'];
 echo $ime;
 
 ?>
 vaše stanje na kontu je: 
<?php
$uprID = $_SESSION['id'];
$konto = mysqli_fetch_array(mysqli_query($povezava,"SELECT konto FROM uporabnik WHERE ID = '$uprID'"));
echo $konto[0].'       <a href=http://febox6.duckdns.org/SpletnaStavnica/Uporabniki/'.$uprID.'.php>Moj profil</a>';
$stevecVrstice = 0;
$sql = "SELECT * FROM tekme";
$rezultat = mysqli_query($povezava,$sql);
$tabela = array();
$tabelaD = array();
$tabelaG = array();
$tabelaI = array();
while($vrstica = mysqli_fetch_array($rezultat)){
  for($i = 0; $i < 24;$i++){  
    $drzava = strtoupper($drzave[$i]);
    $pozicijaD = strpos($vrstica[1],$drzava);
    $pozicijaL = strpos($vrstica[6],$lige[$i]);
    if( $pozicijaD !==false and ($vrstica[6] == $lige[$i])){
      $tabela[] = $vrstica;
      //IZRAČUN KVOTE GLEDE NA MESTO NA LESTVICI
      $osnova = 1.00;
      $sqlD = "SELECT ID FROM $drzave[$i] WHERE Ekipa LIKE '%$vrstica[2]%'";
      $sqlG = "SELECT ID FROM $drzave[$i] WHERE Ekipa LIKE '%$vrstica[3]%'";
      $mestoDomaci = mysqli_fetch_array(mysqli_query($povezava,$sqlD));
      $mestoGosti = mysqli_fetch_array(mysqli_query($povezava,$sqlG));
      if($mestoDomaci[0] > $mestoGosti[0]){
          $razlika = $mestoDomaci[0] - $mestoGosti[0];
          switch($razlika) {
            case 1:
            case 2:
              $kvotaDomaci = $osnova + 0.3;
              $kvotaGosti = $osnova + 0.6;
              $kvotaIzenaceno = $osnova + ($kvotaGosti - $kvotaDomaci);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
              break;
            case 3:
            case 4:
              $kvotaDomaci = $osnova + 0.2;
              $kvotaGosti = $osnova + 0.7;
              $kvotaIzenaceno = $osnova + ($kvotaGosti - $kvotaDomaci);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
              break;
            case 5:
            case 6:
              $kvotaDomaci = $osnova + 0.2;
              $kvotaGosti = $osnova + 0.7;
              $kvotaIzenaceno = $osnova + ($kvotaGosti - $kvotaDomaci);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
              break;
            default:
              $kvotaDomaci = $osnova + 0;
              $kvotaGosti = $osnova + (0.2*($razlika-6));
              $kvotaIzenaceno = $osnova + ($kvotaGosti - $kvotaDomaci);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
          }
      }
      else{
          $razlika = $mestoGosti[0] - $mestoDomaci[0];
          switch($razlika) {
            case 1:
            case 2:
              $kvotaGosti = $osnova + 0.3;
              $kvotaDomaci = $osnova + 0.6;
              $kvotaIzenaceno = $osnova + ($kvotaDomaci - $kvotaGosti);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
              break;
            case 3:
            case 4:
              $kvotaGosti = $osnova + 0.2;
              $kvotaDomaci = $osnova + 0.7;
              $kvotaIzenaceno = $osnova + ($kvotaDomaci - $kvotaGosti);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
              break;
            case 5:
            case 6:
              $kvotaGosti = $osnova + 0.2;
              $kvotaDomaci = $osnova + 0.7;
              $kvotaIzenaceno = $osnova + ($kvotaDomaci - $kvotaGosti);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
              break;
            default:
              $kvotaGosti = $osnova + 0;
              $kvotaDomaci = $osnova + (0.2*($razlika+6));
              $kvotaIzenaceno = $osnova + ($kvotaDomaci - $kvotaGosti);
              array_push($tabelaD,$kvotaDomaci);
              array_push($tabelaG,$kvotaGosti);
              array_push($tabelaI,$kvotaIzenaceno);
          }
      }
      ?>
      <script>
      var tekme = <?php echo json_encode($tabela); ?>;
      var uprID = <?php echo json_encode($_SESSION['id']); ?>;
      var kvotaDomaci = <?php echo json_encode($tabelaD); ?>;
      var kvotaGosti = <?php echo json_encode($tabelaG); ?>;
      var kvotaIzenaceno = <?php echo json_encode($tabelaI); ?>;
      </script>
      <?php
      if(strpos($vrstica[7], "Sched") !== false){ /*Če je v $vrsica[7] beseda Sched, potem izpiše gumbe, na katere lahko kliknemo */
        echo "<tr>"."<td>".$vrstica[0]."</td>"." "."<td>".$vrstica[2]."</td>"." "."<td>".$vrstica[3]."</td>"." "."<td>".$vrstica[4]."</td>".
        " "."<td>".$vrstica[5]."</td>"." "."<td>".$vrstica[7]."</td>"." ".
        "<td>"."<button class=".$stevecVrstice." onclick='dodajParDomaci(tekme,this.className,kvotaDomaci)'>".$kvotaDomaci."</button>"."</td>"." "
        ."<td>"."<button class=".$stevecVrstice." onclick='dodajParNeodloceno(tekme,this.className,kvotaIzenaceno)'>".$kvotaIzenaceno."</button>"."</button>"."</td>"." "."<td>"
        ."<button class=".$stevecVrstice." onClick='dodajParGosti(tekme,this.className,kvotaGosti)'>".$kvotaGosti."</button>"."</td>"."</tr>";
        $stevecVrstice = $stevecVrstice + 1;
        break;
    }
    else{
      echo "<tr>"."<td>".$vrstica[0]."</td>"." "."<td>".$vrstica[2]."</td>"." "."<td>".$vrstica[3]."</td>"." "."<td>".$vrstica[4]."</td>".
      " "."<td>".$vrstica[5]."</td>"." "."<td>".$vrstica[7]."</td>"." ".
      "<td>"."<button  disabled class=".$stevecVrstice." onclick='dodajParDomaci(tekme,this.className,kvotaDomaci)'>".$kvotaDomaci."</button>"."</td>"." "
      ."<td>"."<button disabled class=".$stevecVrstice." onclick='dodajParNeodloceno(tekme,this.className,kvotaIzenaceno)'>".$kvotaIzenaceno."</button>"."</button>"."</td>"." "."<td>"
      ."<button disabled class=".$stevecVrstice." onClick='dodajParGosti(tekme,this.className,kvotaGosti)'>".$kvotaGosti."</button>"."</td>"."</tr>";
      $stevecVrstice = $stevecVrstice + 1;
      break;
      
    }
    }

    }
  }    
 ?>
 <!-- DODAJ RAČUNANJE KVOTE IN MOŽNEGA DOBITKA !!!!!!!!!!!!!!!-->
</table>
<div id="stavniListek">
<p class="tekstListek">stavni listek</p>
  <div id="noga">
    <form id="listek" method="post" action="vplacilo.php">
      <p>Skupna kvota:<input type="number" id="sestevekKvot"  step=".01" disabled>
      <input type="submit" id="vplacilo" value="Vplačaj!">
      <input type="number" name="znesek" id="znesek" placeholder="0.50" min="0.50" step="0.5" required oninput="izracun()">
      <p>Mozni dobitek<input type="number" id="mozniDobitek" disabled step=".01" >
      <input type="hidden" name="uprID" value = <?php echo json_encode($_SESSION['id']); ?> >
    </form> 
  </div>
</div>
<script src="script.js"></script>
</body>
</html>
