

<?php

define ('DB_HOST', 'localhost');        // Le serveur

define ('DB_USER', 'root');             // L'utilisateur (sous-entendu le script PHP)

define ('DB_PWD' , 'root');                 // Le mot de passe

define ('DB_NAME', 'db_codenames');             // La DB

define ('MYSQL_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8'); 

// On essaie de se connecter à la DB

try {

    $pdo = new PDO(MYSQL_DSN, DB_USER, DB_PWD);

} catch (PDOException $e) {

    //echo $e->getMessage();       // A mettre ABSOLUMENT en commentaire en prod

    $pdo = null;                 

    $info = ['status' => 'error'];

    echo json_encode($info);

    die(); 

}
?>

