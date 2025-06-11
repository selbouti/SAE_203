<?php
$host = '192.168.156.221';
$db   = 'projet3_tp3';
$user = 'selbouti';
$pass = '6442';
$charset = 'utf8mb4';

//try {
 //   $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
//} catch (PDOException $e) {
 //   die("Erreur de connexion à la base de données : " . $e->getMessage());
//}
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
?>
