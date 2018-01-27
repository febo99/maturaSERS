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

$listki = mysqli_query($povezava,"SELECT listekID FROM stavniListek WHERE datum = '$datum' AND uporabnik_ID = $uprID GROUP BY listekID");
#tekme[2] = tekmaID;
while($listekID = mysqli_fetch_array($listki)){
    echo "<table class='liveListek' id='".$listekID[0]."'>
    <caption>".$listekID[0]."</caption>
    <tr>
    <th>Domaci</th>
    <th>Gosti</th>
    <th>Goli domaci</th>
    <th>Goli gosti</th>
    <th>Status</th>
    <th>Dobitnost</th>
    </tr>
    ";
    $vnosi = mysqli_query($povezava,"SELECT * FROM stavniListek WHERE datum = '$datum' AND 	uporabnik_ID = $uprID AND listekID LIKE '".$listekID[0]."'"); 
    while($vrstica = mysqli_fetch_array($vnosi)){
        echo "<tr>";
        $tekma = mysqli_fetch_array(mysqli_query($povezava, "SELECT domaci,gosti FROM tekme WHERE ID = $vrstica[2]"));
        $rezultat = mysqli_fetch_array(mysqli_query($povezava, "SELECT goliDomaci,goliGosti FROM tekme where ID = $vrstica[2]"));
        $status = mysqli_fetch_array(mysqli_query($povezava,"SELECT Status FROM tekme WHERE ID = $vrstica[2]"));
        echo "<td>".$tekma[0]."</td><td>".$tekma[1]."</td><td>".$rezultat[0]."</td><td>".$rezultat[1]."</td>"."<td>".$status[0]."</td>";
        echo "</tr>";
        
    }
    echo "</table>";
}
?>
</table>
</body>