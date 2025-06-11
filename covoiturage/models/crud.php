<?php
require_once(__DIR__ . '/../config/conf.php');

function createTrajet($id,$lieuDepart, $gpsDepart, $lieuArrivee, $gpsArrivee, $date, $heureDepart, $heureArrivee, $nbr_place, $id_conducteur, $participation, $typeTrajet, $points_intermediaires) {
    global $pdo;
    $sql = "INSERT INTO trajet (id,lieuDepart, gpsDepart, lieuArrivee,
     gpsArrivee, date, heureDepart, heureArrivee, nbr_place, id_conducteur,
      participation, typeTrajet, points_intermediaires)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id,$lieuDepart, $gpsDepart, $lieuArrivee, $gpsArrivee, $date, $heureDepart, $heureArrivee, $nbr_place, $id_conducteur, $participation, $typeTrajet, $points_intermediaires]);
}

