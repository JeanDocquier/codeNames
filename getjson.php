<?php //tout supprimer de la page html comme quand on y joinait un css
//connexion au serveur
try {
$dns='mysql:host=localhost;dbname=db_codenames';
$utilisateur='root';
$motdepasse='root'; //on ne met rien dans les guillemets parce qu'il n'y a pas de mdp
$maconnexion= new PDO ($dns, $utilisateur, $motdepasse);
$maconnexion->exec("SET CHARACTER SET utf8");
} catch (Exception $e) {
	echo "Connexion au serveur db impossible :", $e->getMessage();
	die();
	}


   // echo $_SESSION['iduser'];

    $sql = "SELECT * FROM tb_mots ORDER BY RAND() LIMIT 25 ";   
    $select=$maconnexion->prepare($sql); //"prepare" permet de faire une requête sur laquelle on agit
    $select->execute();
    $emparray = array();                 
    while($record = $select->fetch(PDO::FETCH_ASSOC)){       
        $emparray[] = $record;
     }    
    header('Content-type: application/json');   
    echo json_encode($emparray);
?>