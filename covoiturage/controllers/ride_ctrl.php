<?php
require_once(__DIR__ . '/../models/crud.php');
require(__DIR__ . '/../controllers/auth_ctrl.php');

function handleRideSubmission() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id= 7 ;
        $lieuDepart = $_POST['lieuDepart'];
        $gpsDepart = $_POST['gpsDepart'];
        $lieuArrivee = $_POST['lieuArrivee'];
        $gpsArrivee = $_POST['gpsArrivee'];
        $date = $_POST['date'];
        $heureDepart = $_POST['heureDepart'];
        $heureArrivee = $_POST['heureArrivee'];
        $nbr_place = $_POST['nbr_place'];
        $id_conducteur = $_SESSION['login']; // à adapter selon la session utilisateur
        
        $participation = $_POST['participation'];
        $typeTrajet = $_POST['typeTrajet'];
        $points_intermediaires = $_POST['points_intermediaires'];

        $success = createTrajet($id,$lieuDepart, $gpsDepart, $lieuArrivee, $gpsArrivee, $date, $heureDepart, $heureArrivee, $nbr_place, $id_conducteur, $participation, $typeTrajet, $points_intermediaires);

        if ($success) {
            header('Location: index.php?route=trajets');
            exit;
        } else {
            echo "Erreur lors de la proposition de trajet.";
        }
    }
}
