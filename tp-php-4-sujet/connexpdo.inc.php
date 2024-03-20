<?php

function connexpdo($db){
    $sgbd = "mysql";
    $host = "localhost";
    $port = 3306;
    $charset = "UTF8";
    $user = "root";
    $mdp = "Pu1nod";
    
    $pdo = new pdo("$sgbd:host=$host;port=$port;charset=$charset;dbname=$db", $user, $mdp);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

?>