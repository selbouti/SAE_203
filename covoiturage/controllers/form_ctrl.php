<?php
function form_submit_ctrl() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();}
    
     if (!isset($_SESSION['uid'])) {
        header("Location: index.php?route=login"); 
        exit;
    }
    
    global $pdo;
    $uid = $_SESSION['uid'];
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE id = ?");
    $stmt->execute([$uid]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        header("Location: index.php?route=trajets");
        exit;
    }
    require(__DIR__ . '/../config/conf.php');

    $uid = $_SESSION['uid'];
    $nom_complet = $_POST['nom'];
    $sujet = $_POST['sujet'];
    $adresse = $_POST['adresse'];
    $gps = $_POST['gps'];
    $departement = $_POST['departement'];
    $niveau = $_POST['niveau'];

    $stmt = $pdo->prepare("INSERT INTO etudiant (id, nom, role, adresse, gps, departement, niveau) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$uid, $nom_complet, $sujet, $adresse, $gps, $departement, $niveau]);

    header("Location: index.php?route=trajets");
    exit;
}
