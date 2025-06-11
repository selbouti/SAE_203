<?php
function form_submit_ctrl() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();}
    require('/var/www/html/dev/SAE_R203-main/SAE203_FULL/config/conf.php');

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
