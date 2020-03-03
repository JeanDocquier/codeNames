<?php 
session_start();
header("Content-Type: text/event-stream\n\n");
require_once('connexiondbPDO.php');

$lastwordclicked;
$sql = 'SELECT * FROM tb_partie 
                WHERE id_partie = :partie';
                $response = $pdo->prepare($sql);
                $response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
                $response->execute();
                
if($result = $response->fetch(PDO::FETCH_OBJ)){
    $lastwordclicked = $result->dernier_mot_clique_place ;
}

$sqlQuery = 'SELECT * FROM tb_elementgrille
                INNER JOIN tb_partie
                ON tb_elementgrille.partie_id = tb_partie.id_partie
                WHERE place = :place 
                AND partie_id= :partie';
                $response2 = $pdo->prepare($sqlQuery);
                $response2->bindValue(':place', $lastwordclicked, PDO::PARAM_STR);
                $response2->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
                $response2->execute();

if($result2 = $response2->fetch(PDO::FETCH_OBJ)){
    //echo $result->team;
}


  // Chaque seconde, envoi d’un évènement "ping".

  echo "event: ping\n";
  echo 'data: {"place": "' . $result2->place . '", "team": "' . $result2->team . '", "hint": "' . $result2->indice_courant . '"}';
  echo "\n\n";



  ob_end_flush();
  flush();
  sleep(2);







?>
