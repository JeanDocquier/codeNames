<?php
session_start();
//header("Content-Type: text/event-stream\n\n");
ini_set('display_errors', 1);
require_once('connexiondbPDO.php');
$mywordclickedplace = $_GET['mywordclickedplace'];
$_SESSION['wordclicked'] = $mywordclickedplace;
$mywordclickedplace = $_SESSION['wordclicked'];

/** UPDATE DU MOT, FIND = 1 **/
$updateSQL = "UPDATE tb_elementgrille SET find= :found WHERE place= :place AND partie_id= :partie";
$response = $pdo->prepare($updateSQL);
$response->bindValue(':found', 1, PDO::PARAM_STR);
$response->bindValue(':place', $mywordclickedplace, PDO::PARAM_STR);
$response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->execute();
/** FIN UPDATE MOT, FIND = 1 **/


/** UPDATE DERNIER MOT CLIQUE PLACE **/
$updateSQL2 = "UPDATE tb_partie SET dernier_mot_clique_place = :lastclicked WHERE id_partie = :partie";
$response2 = $pdo->prepare($updateSQL2);
$response2->bindValue(':lastclicked', $mywordclickedplace, PDO::PARAM_STR);
$response2->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response2->execute();
/** UPDATE DERNIER MOT CLIQUE PLACE**/




$sqlQuery = 'SELECT * FROM tb_elementgrille
                WHERE place = :place 
                AND partie_id= :partie';
                $response = $pdo->prepare($sqlQuery);
                $response->bindValue(':place', $mywordclickedplace, PDO::PARAM_STR);
                $response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->execute();



header('Content-type: application/json');   
if($result = $response->fetch(PDO::FETCH_OBJ)){
    // $resultSet reçoit en une fois un tableau (indexé) de tableaux (asssociatifs)
    $info = $result;
    echo json_encode($info);

} else {
    $info = ['status' => 'ok', 'result' => '[]'];
    echo json_encode($info);
}
/** UPDATE NOMBRE DE MOT RESTANT A TROUVER **/

if($result->team == "redteam" ){
    $updateSQL2 = "UPDATE tb_partie SET mot_joueur1 = mot_joueur1 -1 WHERE  id_partie= :partie";
    $response2 = $pdo->prepare($updateSQL2);
    $response2->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
    $response2->execute();
}   
else if($result->team == "blueteam" ){
    $updateSQL2 = "UPDATE tb_partie SET mot_joueur2 = mot_joueur2 - 1 WHERE  id_partie= :partie";
    $response2 = $pdo->prepare($updateSQL2);
    $response2->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
    $response2->execute();
}

/** FIN UPDATE NOMBRE DE MOT RESTANT A TROUVER **/

?>
