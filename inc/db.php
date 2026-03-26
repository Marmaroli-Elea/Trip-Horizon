<?php
//Connexion à la base
$dsn = 'mysql:host=mysql;dbname=TripHorizon;charset=utf8';
$user = 'root';
$password = 'rootpass';

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
    exit;
}