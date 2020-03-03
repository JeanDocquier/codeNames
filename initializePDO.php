
<?php 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$mypartie;
require_once('connexiondbPDO.php');



/***** CREATION PARTIE ***/
$insertSQL = "INSERT INTO tb_partie (id_joueur1, id_joueur2) 
                VALUES (:joueur1, :joueur2)";
$response = $pdo->prepare($insertSQL);
$response->bindValue(':joueur1', 111, PDO::PARAM_STR);
$response->bindValue(':joueur2', 222, PDO::PARAM_STR);
$response->execute();
/***** FIN CREATION PARTIE ***/






/***** RECUPERATION DE L'ID DE LA PARTIE CREEE ***/

$sqlQuery = 'SELECT * FROM tb_partie
                ORDER BY id_partie DESC LIMIT 1';
                $response = $pdo->prepare($sqlQuery);
$response->execute();
if($result = $response->fetch(PDO::FETCH_OBJ)){
    $mypartie = $result->id_partie;
    $_SESSION['gameIDtoload'] = $result->id_partie;
}
///***** FIN RECUPERATION DE L'ID DE LA PARTIER CREE ***/




/***** RECUPERATION DE 25 MOTS RANDOM ***/
$sqlQuery2 = 'SELECT * FROM tb_mots ORDER BY RAND() LIMIT 26'; 
$response2 = $pdo->prepare($sqlQuery2);
$response2->execute();
$myarray = array(8, 7 , 10);
$i = 1;
$j = 1;
$team;
if($result2 = $response2->fetch(PDO::FETCH_OBJ)){
    while($result2 = $response2->fetch(PDO::FETCH_OBJ)) {
    if ($j >5){
        $j=1;
        $i++;
    }
    $place = $i ."x".$j;
    $random = rand (0, 2);
    while ($myarray[$random] == 0){
        $random = rand (0, 2);
    }    
    if($random == 0) {
        $team = "redteam";
    }
    else if($random == 1){
        $team = "blueteam";
    }
    else if ($random == 2){
        $team = "neutral";
    }
//    else if ($random == 3){
//        $team = "blackword";
//    } 
    insertElementGrilleIntoDB($team, $place, $mypartie, $pdo, $response, $insertSQL, $result2->mots);
    //insertElementGrilleIntoHTMLPlayerOne($result2->mots, $place, $team);
    $myarray[$random]--;
    $j++;
    }
}
/** RANDOMISATION DU MOT NOIR SUR BASE DES MOTS NEUTRES **/
$updateSQL = 'UPDATE `tb_elementgrille` 
                SET team="blackword" 
                WHERE team="neutral" 
                AND partie_id=:partie 
                ORDER BY RAND() limit 1 ';
                $response = $pdo->prepare($updateSQL);
                $response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->execute();
/** FIN RANDOMISATION DU MOT NOIR SUR BASE DES MOTS NEUTRES **/


header("Refresh:0; url=loadPDO.php");
function insertElementGrilleIntoDB($theteam, $theplace, $themypartie, $thepdo, $theresponse, $theinsertSQL, $theword){

$theinsertSQL = "INSERT INTO tb_elementgrille (mot, place, team, partie_id) 
                VALUES  (:mymot, 
                        :myplace,
                        :myteam,
                        :mypartie_id)";
$theresponse = $thepdo->prepare($theinsertSQL);
$theresponse->bindValue(':mymot', $theword, PDO::PARAM_STR);
$theresponse->bindValue(':myplace', $theplace, PDO::PARAM_STR);
$theresponse->bindValue(':myteam', $theteam, PDO::PARAM_STR);
$theresponse->bindValue(':mypartie_id', $themypartie, PDO::PARAM_STR);
$theresponse->execute();    
}
function insertElementGrilleIntoHTMLPlayerOne($theword, $theplace, $theteam){
    echo ('<div class="a-word" data-grid_place="' . $theplace . '" data-team="'. $theteam . '">'.$theword.'</div>'); 
}
?>