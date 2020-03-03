<?php
require_once('connexiondbPDO.php');
session_start();
if($_SESSION['player'] == "playerOne"){
$indice = $_GET['myindice'];    
echo $updateSQL = "UPDATE tb_partie SET tour_courant = 2, indice_courant = :indice  WHERE id_partie= :partie";
$response = $pdo->prepare($updateSQL);
$response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->bindValue(':indice', $indice, PDO::PARAM_STR);
$response->execute();
}
else{
$updateSQL = "UPDATE tb_partie SET tour_courant = 1  WHERE id_partie= :partie";
$response = $pdo->prepare($updateSQL);
$response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->execute();
    
}


?>