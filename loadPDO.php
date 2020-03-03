<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="css/styles.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
    <title>Code Names</title>

</head>

<body>
    <div class="id_parteid">
        Partie numéro : <?php echo $_SESSION['gameIDtoload']; ?>
    </div>
    <div class="words-wrapper">
        <?php
        
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connexiondbPDO.php');
/** RECUPERATION DE LA PARTIE SELON ID **/
$sqlQuery = 'SELECT * FROM tb_elementgrille 
                WHERE partie_id = :partie';
                $response = $pdo->prepare($sqlQuery);
                $response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->execute();

//if ($response->rowCount() > 0) {
//    // $resultSet reçoit en une fois un tableau (indexé) de tableaux (asssociatifs)
//    $resultSet = $response->fetchAll(PDO::FETCH_ASSOC);
//    $info = $resultSet;
//    echo json_encode($info);
//} else {
//    $info = ['status' => 'ok', 'result' => '[]'];
//    echo json_encode($info);
//}

while($result = $response->fetch(PDO::FETCH_OBJ)){
    if ($_SESSION['player'] == "playerOne"){
        loadElementsGridIntoHTMLPlayerOne($result->mot, $result->place, $result->team, $result->find);
    }
    else if ($_SESSION['player'] == "playerTwo"){
        loadElementsGridIntoHTMLPlayerTwo($result->mot, $result->place, $result->team, $result->find);
    }
}
function loadElementsGridIntoHTMLPlayerOne($theword, $theplace, $theteam, $found){
    echo ('<div class="a-word'); 
    if ($found == 1){
        echo ' found"';
    }
    else{
        echo '"';
    }
    echo ('data-grid_place="' . $theplace . '" data-team="'. $theteam . '">'.$theword.'</div>'); 
}
function loadElementsGridIntoHTMLPlayerTwo($theword, $theplace, $theteam, $found){
    echo ('<div class="a-word'); 
    if ($found == 1){
        echo ' found" data-team="' . $theteam . '"';
    }
    else{
        echo '"';
    }
    echo ('data-grid_place="' . $theplace . '">'.$theword.'</div>'); 
}

?>
    </div>
    <?php 
    $sqlQuery = 'SELECT * FROM tb_partie 
                WHERE id_partie = :partie';
                $response = $pdo->prepare($sqlQuery);
                $response->bindValue(':partie', $_SESSION['gameIDtoload'], PDO::PARAM_STR);
$response->execute();
if($result = $response->fetch(PDO::FETCH_OBJ)){
    
    ?>


    <input type="hidden" name="redwordsremaning" value="<?php echo $result->mot_joueur1; ?>">
    <input type="hidden" name="bluewordsremaning" value="<?php echo $result->mot_joueur2; ?>">
    <?php } ?>
    <div class="wrapper">
        JEU FINI !
    </div>

        <div class="menu-button"><i class="fas fa-cog"></i></div>

    <?php if ($_SESSION['player'] == "playerOne"){ ?>

    <div class="view"><i class="fas fa-eye"></i></div>

    <div class="menu">

        <div class="indice">
            <span>Votre indice</span>
            <input class="indice_mot" type="text">
            en <input class="indice_nombre" type="number">
        </div>
        <button class="fin_de_tour">Finir Tour</button>

    </div>
    <?php } 
    
    else{
        ?><div style="display:none;" class="view"><i class="fas fa-eye"></i></div>
    <div class="menu">

        <div class="indice-donne">
        <?php echo $result->indice_courant; ?>
    </div>
        <button class="fin_de_tour">Finir Tour</button>

    </div>
       
       <?php
    }?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="js/custom.min.js"></script>
</body>

</html>
