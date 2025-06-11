<?php
require_once('config/conf.php');
require_once('models/crud.php');

function handleRideSubmission() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération sécurisée des champs du formulaire
        $lieuDepart = $_POST['lieuDepart'] ?? '';
        $gpsDepart = $_POST['gpsDepart'] ?? '';
        $lieuArrivee = $_POST['lieuArrivee'] ?? '';
        $gpsArrivee = $_POST['gpsArrivee'] ?? '';
        $date = $_POST['date'] ?? '';
        $heureDepart = $_POST['heureDepart'] ?? '';
        $heureArrivee = $_POST['heureArrivee'] ?? '';
        $nbr_place = (int)($_POST['nbr_place'] ?? 0);
        $id_conducteur = 1; // À modifier selon session utilisateur
        $participation = (float)($_POST['participation'] ?? 0.0);
        $typeTrajet = $_POST['typeTrajet'] ?? '';
        $points_intermediaires = $_POST['points_intermediaires'] ?? '';

        // Vérifier que les champs obligatoires sont remplis
        if ($lieuDepart && $lieuArrivee && $date && $heureDepart && $nbr_place > 0) {
            $success = createTrajet(
                $lieuDepart, $gpsDepart, $lieuArrivee, $gpsArrivee,
                $date, $heureDepart, $heureArrivee, $nbr_place,
                $id_conducteur, $participation, $typeTrajet, $points_intermediaires
            );

            if ($success) {
                header('Location: index.php?route=rides');
                exit;
            } else {
                echo "Erreur lors de la proposition de trajet.";
            }
        } else {
            echo "Merci de remplir tous les champs obligatoires.";
        }
    }
}
