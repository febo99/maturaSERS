<?php
require("povezavaBaza.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uprID = $_POST['uprID'];
    $znesek = $_POST['znesek'];
    $listek = mysqli_query($povezava,"SELECT stevilkaListka FROM uporabnik WHERE ID = '$uprID'");
    $listekVrednost = mysqli_fetch_array($listek);
    $listekID = $listekVrednost[0];
    $upr = strval($uprID);
    $listekZdruzeno = $upr.$listekID;
    $listekVnos = intval($listekZdruzeno);
    $konto = mysqli_fetch_array(mysqli_query($povezava,"SELECT konto FROM uporabnik WHERE ID = '$uprID'"));

    $datum = strval(date('j/n/Y'));
    if($znesek > $konto[0]){
        echo "Premalo denarja!";
    }
    else{
    foreach($_POST as $vrednost){
        if($vrednost == $uprID){
            continue;
        }
        if($vrednost == $znesek){
            continue;
        }
        else {
            $tekma = explode("x", $vrednost,2);
            $tekmaID = $tekma[0]; //Explode vrne array
            $tip = substr($vrednost, strpos($vrednost, "x")+1);
            $kvota = substr($vrednost, strpos($vrednost,"y")+1);
            $domaci = mysqli_fetch_array(mysqli_query($povezava,"SELECT Domaci FROM tekme WHERE ID = '$tekmaID'")); 
            $gosti = mysqli_fetch_array(mysqli_query($povezava,"SELECT Gosti FROM tekme WHERE ID = '$tekmaID'"));
            echo $kvota;
            echo $tekmaID.$tip."<br>";
            $poizvedba = "INSERT INTO stavniListek(listekID,uporabnik_ID,tekmaID,domaci,gosti,tip,kvota,vlozenaSredstva,datum,goliD,goliG) VALUES ('$listekVnos','$uprID','$tekmaID','$domaci[0]','$gosti[0]','$tip','$kvota','$znesek','$datum',0,0)";
            mysqli_query($povezava, $poizvedba);    
            
        }
    }
    mysqli_query($povezava, "UPDATE uporabnik SET stevilkaListka = stevilkaListka + 1 WHERE ID = '$uprID'");
    $kontoMinus = "UPDATE uporabnik SET konto = konto - '$znesek' WHERE ID = '$uprID'";
    mysqli_query($povezava,$kontoMinus);
    }

    }










?>