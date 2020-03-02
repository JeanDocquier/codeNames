<?php //tout supprimer de la page html comme quand on y joinait un css
//connexion au serveur
require_once('connexiondb.php');

   // echo $_SESSION['iduser'];
    echo $name;
    $sql = "SELECT * FROM tb_mots ORDER BY RAND() LIMIT 25 ";   
       $result = mysqli_query($conn, $sql);

        $emparray = array();                 
    while($row = mysqli_fetch_assoc($result)) {
            $emparray[] = $record;
         }    
        header('Content-type: application/json');   
        echo json_encode($emparray);
?>