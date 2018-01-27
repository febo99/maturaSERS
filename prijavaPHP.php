<?php
  require("povezavaBaza.php");
  session_start();
  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $uprIme = $_POST['uprIme'];
      $geslo = $_POST['geslo'];
      $geslo = hash('sha1',$geslo);
      $poizvedba = "SELECT ID FROM uporabnik WHERE uporabniskoIme = '$uprIme' and geslo = '$geslo' ";
      $rezultat = mysqli_query($povezava,$poizvedba);
      $vrstica = mysqli_fetch_array($rezultat);
      $stevec = mysqli_num_rows($rezultat);
      $ID = $vrstica[0];
      if($stevec >= 1){
          $_SESSION['uprIme'] = $uprIme;
          $_SESSION['id'] = $ID;
        header("location: stavnica.php");
      }
      else{
        header("location: napaka.php");
      }
    }
 ?>
