<?php
  require("povezavaBaza.php");
  if(isset($_POST['poslji']) && $_POST['g-recaptcha-response']!=""){
    $skrivnost = "6LdcmTYUAAAAAMWjUtRbNCapZ6Flubh6HIkkwSB6";
    $potrdiOdgovor = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$skrivnost.'&response='.$_POST['g-recaptcha-response']);
    $odgovor = json_decode($potrdiOdgovor);
    if($odgovor ->success){
    $uprIme = $_POST['uprIme'];
    $email = $_POST['email'];
    $geslo = $_POST['geslo'];
    $geslo = hash('sha1',$geslo);
    $stevilo = 1;
    if(mysqli_num_rows(mysqli_query($povezava,"SELECT * FROM uporabnik WHERE uporabniskoIme = '$uprIme'")) > 0){ #če v sistemu ni enakega uporabniškega imena, naredi novega
      echo '<h1>Napaka</h1>';
    }
    else{
    $poizvedba = "INSERT INTO uporabnik (uporabniskoIme,geslo,eposta,stevilkaListka) VALUES ('$uprIme','$geslo','$email','$stevilo') ";
    mysqli_query($povezava,"SET NAMES utf8");
    mysqli_query($povezava,"SET CHARACTER SET utf8");
    mysqli_query($povezava,"SET COLLATION_CONNECTION='utf8_general_ci'");
    $rezultat = mysqli_query($povezava ,$poizvedba);
    $uprID = mysqli_fetch_array(mysqli_query($povezava, "SELECT ID from uporabnik WHERE uporabniskoIme = '$uprIme'"));
    $pot = $_SERVER['DOCUMENT_ROOT'] . '/SpletnaStavnica/Uporabniki/'.$uprID[0].'.php';
    $pot2 = $_SERVER['DOCUMENT_ROOT'] . '/SpletnaStavnica/Listki/'.$uprID[0].'.txt';
    $potTemplate = $_SERVER['DOCUMENT_ROOT'] . '/SpletnaStavnica/Uporabniki/profil.php';
    $profil = fopen($pot,"a+");
    $tekme = fopen($pot2, "a+");
    $template = file_get_contents($potTemplate);
    file_put_contents($pot, $template);
    fclose($tekme);
    fclose($profil);
    if($rezultat){
      echo '<h1>USPEŠNO</h1>';

    }else{
      echo '<h1>NE</h1>'.mysqli_error($povezava);
    }
}
    }
}else{

}

 ?>
