<head>
<title>Moj profil</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php
include("../prijavaPHP.php");
include("../povezavaBaza.php");
$uprID = $_SESSION['id'];
$datum = date('j/n/Y');
$datoteka = fopen($pot, "r+");
$listki = mysqli_query($povezava,"SELECT listekID FROM stavniListek WHERE datum = '$datum' AND uporabnik_ID = $uprID GROUP BY listekID");
$vnosVtxt = mysqli_query($povezava,"SELECT listekID,datum FROM stavniListek WHERE uporabnik_ID = $uprID");

while($listekID = mysqli_fetch_array($listki)){ #Ustvari posamezen LIVE listek
    $kvota = 1;
    echo "<table class='liveListek' id='".$listekID[0]."'>
    <caption>".$listekID[0]."</caption>
    <tr>
    <th>Domaci</th>
    <th>Gosti</th>
    <th>Goli domaci</th>
    <th>Goli gosti</th>
    <th>Tip</th>
    <th>Dobitnost</th>
    </tr>
    ";
    $vnosi = mysqli_query($povezava,"SELECT * FROM stavniListek WHERE datum = '$datum' AND 	uporabnik_ID = $uprID AND listekID LIKE '".$listekID[0]."'"); 
    while($vrstica = mysqli_fetch_array($vnosi)){
        echo "<tr>";
        $kvota *= $vrstica[6];
        $denar = $vrstica[7];
        $tekma = mysqli_fetch_array(mysqli_query($povezava, "SELECT domaci,gosti FROM tekme WHERE ID = $vrstica[2]"));
        $rezultat = mysqli_fetch_array(mysqli_query($povezava, "SELECT goliDomaci,goliGosti FROM tekme where ID = $vrstica[2]"));
        $status = mysqli_fetch_array(mysqli_query($povezava,"SELECT dobitno FROM stavniListek WHERE tekmaID = $vrstica[2]"));
        $cas = mysqli_fetch_array(mysqli_query($povezava, "SELECT status FROM tekme WHERE ID = $vrstica[2]")); /* POPRAVI, DA POGLEDA SAMO LISTEK, KER JE UPDATE V PYTHONU!*/
        echo "<td>".$tekma[0]."</td><td>".$tekma[1]."</td><td>".$rezultat[0]."</td><td>".$rezultat[1]."</td><td>".$vrstica[5]."</td>";

        #STATUS TEKME DOLOČI DOBITNOST
        if(strpos($cas[0], "Sched") !== false){
            echo "<td><img class='neznano' src='../Slike/neznano.png'></td>";
            echo "</tr>";
        }
        elseif(strpos($cas[0], "FTR") or strpos($status,"Fin") !== false){
            if(($rezultat[0] > $rezultat[1]) && ($vrstica[5] == 1)){
                echo "<td><img class='prav' src='../Slike/prav.png'></td>";
                echo "</tr>";
                mysqli_query($povezava, "UPDATE stavniListek SET goliD = $rezultat[0], goliG = $rezultat[1], dobitno = 1  WHERE listekID LIKE '".$listekID[0]."'");
                echo "<tr><td><b>Kvota: </b>".$kvota."</td><td><b>Vplačilo:</b> $denar</td><td id='dobitek'><b>Dobitek:  </b>".$kvota*$denar."</td></tr>";
                if($status === NULL){
                    mysqli_query($povezava, "UPDATE uporabnik SET konto = konto + $kvota*$denar");
                }
            }

            if(($rezultat[0] < $rezultat[1]) && ($vrstica[5] == 2)){
                echo "<td><img class='prav' src='../Slike/prav.png'></td>";
                mysqli_query($povezava, "UPDATE stavniListek SET goliD = $rezultat[0], goliG = $rezultat[1], dobitno = 1  WHERE listekID LIKE '".$listekID[0]."'");
                echo "</tr>";
                echo "<tr><td><b>Kvota: </b>".$kvota."</td><td><b>Vplačilo:</b> $denar</td><td id='dobitek'><b>Dobitek:  </b>".$kvota*$denar."</td></tr>";
                if($status === NULL){
                    mysqli_query($povezava, "UPDATE uporabnik SET konto = konto + $kvota*$denar");
                }
            }

            if($rezultat[0] == $rezultat[1] && $vrstica[5] == 0){
                echo "<td><img class='prav' src='../Slike/prav.png'></td>";
                mysqli_query($povezava, "UPDATE stavniListek SET goliD = $rezultat[0], goliG = $rezultat[1], dobitno = 1  WHERE listekID LIKE '".$listekID[0]."'");
                echo "</tr>";
                echo "<tr><td><b>Kvota: </b>".$kvota."</td><td><b>Vplačilo:</b> $denar</td><td id='dobitek'><b>Dobitek:  </b>".$kvota*$denar."</td></tr>";
                if($status === NULL){
                    mysqli_query($povezava, "UPDATE uporabnik SET konto = konto + $kvota*$denar");
                }
            }
            else{
                echo "<td><img class='narobe' src='../Slike/narobe.png'></td>";
                mysqli_query($povezava, "UPDATE stavniListek SET goliD = $rezultat[0], goliG = $rezultat[1]  WHERE listekID LIKE '".$listekID[0]."'");
                echo "</tr>";
                echo "<tr><td><b>Kvota: </b>".$kvota."</td><td><b>Vplačilo:</b> $denar</td><td id='napacno'><b>Dobitek:  </b>".$kvota*$denar."</td></tr>";
                
            }
        }
        elseif(strpos($cas[0], "Post") !== false){
            echo "<td><img class='narobe' src='../Slike/narobe.png'></td>";
            mysqli_query($povezava, "UPDATE stavniListek SET goliD = $rezultat[0], goliG = $rezultat[1]  WHERE listekID LIKE '".$listekID[0]."'");
            echo "</tr>";
            echo "<tr><td><b>Kvota: </b>".$kvota."</td><td><b>Vplačilo:</b> $denar</td><td id='napacno'><b>Dobitek:  </b>".$kvota*$denar."</td></tr>";
        }
        else{
            echo "<td><img class='neznano' src='../Slike/neznano.png'></td>";
            mysqli_query($povezava, "UPDATE stavniListek SET goliD = $rezultat[0], goliG = $rezultat[1]  WHERE listekID LIKE '".$listekID[0]."'");
            echo "</tr>";
            echo "<tr><td><b>Kvota: </b>".$kvota."</td><td><b>Vplačilo:</b> $denar</td><td><b>Dobitek:  </b>".$kvota*$denar."</td></tr>";
        }  
    }  
    echo "</table>";
}
#zapis starih listkov
$stariListek = mysqli_query($povezava,"SELECT * FROM stavniListek WHERE uporabnik_ID = $uprID AND datum <> '$datum' GROUP BY listekID");
while($starilistekID = mysqli_fetch_array($stariListek)){
    $kvota = 1;
    echo "<table class='liveListek' id='".$starilistekID[0]."'>
    <caption>".$starilistekID[0]."</caption>
    <tr>
    <th>Domaci</th>
    <th>Gosti</th>
    <th>Tip</th>
    <th>Rezultat</th>
    <th>Dobitnost</th>
    </tr>
    ";

    $stariVnosi = mysqli_query($povezava,"SELECT * FROM stavniListek WHERE datum <> '$datum' AND uporabnik_ID = $uprID AND listekID LIKE '".$starilistekID[0]."'"); 
    while($staraVrstica = mysqli_fetch_array($stariVnosi)){
        if($staraVrstica[9] == 1){
            echo "<td>".$staraVrstica[3]."</td><td>".$staraVrstica[4]."</td><td>".$staraVrstica[5]."</td><td>".$staraVrstica[10].":".$staraVrstica[11]."</td>"."<td>"."<img class='prav' src='../Slike/prav.png'>"."</td>";
            echo "</tr>";
    }
        if($staraVrstica[9] == 0){
            echo "<td>".$staraVrstica[3]."</td><td>".$staraVrstica[4]."</td><td>".$staraVrstica[5]."</td><td>".$staraVrstica[10].":".$staraVrstica[11]."</td>"."<td>"."<img class='narobe' src='../Slike/narobe.png'></td>"."</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}








echo "</table>";

?>
</table>
</body>