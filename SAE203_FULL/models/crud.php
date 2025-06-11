<?php
require_once(__DIR__ . '/../config/conf.php');

function createTrajet($lieuDepart, $gpsDepart, $lieuArrivee, $gpsArrivee, $date, $heureDepart, $heureArrivee, $nbr_place, $id_conducteur, $participation, $typeTrajet, $points_intermediaires) {
    global $pdo;
    $sql = "INSERT INTO trajet (lieuDepart, gpsDepart, lieuArrivee, gpsArrivee, date, heureDepart, heureArrivee, nbr_place, id_conducteur, participation, typeTrajet, points_intermediaires)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$lieuDepart, $gpsDepart, $lieuArrivee, $gpsArrivee, $date, $heureDepart, $heureArrivee, $nbr_place, $id_conducteur, $participation, $typeTrajet, $points_intermediaires]);
}


// Récupération de tous les trajets
function getAllRides() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM trajet ORDER BY date DESC, heureDepart DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}