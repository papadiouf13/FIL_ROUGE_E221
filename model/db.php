<?php
function get_connection() {
    $conn = null;
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    
    //On essaie de se connecter
    try{
        if ($conn == null) {
            $conn = new PDO("mysql:host=$servername;dbname=gestion_atelier_couture", $username, $password);
            //On définit le mode d'erreur de PDO sur Exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }
    /*On capture les exceptions si une exception est lancée et on affiche
     *les informations relatives à celle-ci*/
    catch(PDOException $e){
      echo( "Erreur : " . $e->getMessage());
    }

    return $conn;
}
function fermer_connection_bd(PDO $pdo) {
    $pdo = null;
}