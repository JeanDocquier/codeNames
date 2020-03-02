<?php
session_start();
ini_set('display_errors', 1);
require_once('connexiondb.php');
$mydata = $_GET['mydata'];

$insertSQL = sprintf("INSERT INTO tb_partie (id_joueur1, id_joueur2) VALUES ('%s' ,'%s')",
                            1,
                            2);
$nbrrecord=$maconnexion->exec($insertSQL);	

$link = mysqli_connect("localhost", "root", "root", "db_codenames");
$sql = "SELECT * FROM tb_partie ORDER BY id_partie DESC LIMIT 1";
$mypartie;
if($result = mysqli_query($link, $sql)){
    if($row = mysqli_fetch_array($result)){
         $mypartie = $row['id_partie'];
        $_SESSION['partie'] = $mypartie;

    }
}
echo $mypartie;

for ($i = 0 ; $i< count($mydata) ; $i++){
        $insertSQL2 = sprintf("INSERT INTO tb_elementgrille (mot, place, team, partie_id) VALUES ('%s' ,'%s','%s','%s')",
                            $mydata[$i][2],
                            $mydata[$i][0],
                            $mydata[$i][1],
                            $mypartie);
    $nbrrecord2=$maconnexion->exec($insertSQL2);	
    
  
}
?>
