<?php 
session_start();
require_once('connexiondbPDO.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$wordtoadd = $_GET['mywordtoadd'];
//$wordtoadd = "Gourde";
$emparray = array();                 
$message;

/***** CHECK SI MOT DEJA PAS DANS DB ********/

$sqlQuery = 'SELECT * FROM tb_mots WHERE mots = :mot';
                $response = $pdo->prepare($sqlQuery);
                $response->bindValue(':mot', $wordtoadd, PDO::PARAM_STR);
                $response->execute();
/***** ON CHECK SI LE MOT EXISTE DEJA DANS LA DB ********/
if($result = $response->fetch(PDO::FETCH_OBJ)){ 
    // SI IL EXISTE DEJA, ON ENVOI UN MESSAGE D'ERREUR
    $message = "Le mot existait déjà ! ";
    $emparray[] = $message;
}
else{
    // SI IL N'EXSITE PAS, ON ENVOI UN MESSAGE DE SUCCES
    $message = "Le mot a bien été rajouté dans la DB ! ";
    $emparray[] = $message;
    /***** AJOUT MOT DANS DB  ******/
    $insertSQL = "INSERT INTO tb_mots (mots) 
                    VALUES (:mot)";
    $response = $pdo->prepare($insertSQL);
    $response->bindValue(':mot', $wordtoadd, PDO::PARAM_STR);
    $response->execute();
    /***** FIN AJOUT MOT DANS DB  ******/
}
header('Content-type: application/json');
    echo json_encode($emparray);
?>