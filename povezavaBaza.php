<?php
  define("naslov", 'localhost');
  define("baza", 'stavnica');
  define("uporabnik",'root');
  define("geslo",'rdecastrela6');

  $povezava = mysqli_connect(naslov,uporabnik,geslo) or die("Povezava ni uspela".mysqli_error($povezava));
  $izbranaBaza = mysqli_select_db($povezava,'stavnica') or die("Povezava ni uspela".mysqli_error($povezava));
?>
