<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('connexiondb.php');
/** RECUPERATION DE LA PARTIE SELON ID **/
$sql = "SELECT * FROM tb_elementgrille WHERE partie_id = '" .$_SESSION['gameIDtoload']. "'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    loadElementGrilleIntoHTMLPlayerOne($row['mot'], $row['place'], $row['team'], $row['find']);
}









function loadElementGrilleIntoHTMLPlayerOne($theword, $theplace, $theteam, $found){
    echo ('<div class="a-word'); 
    if ($found == 1){
        echo ' found"';
    }
    else{
        echo '"';
    }
    echo ('data-grid_place="' . $theplace . '" data-team="'. $theteam . '">'.$theword.'</div>'); 
}

?>