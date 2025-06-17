<?php
require_once(__DIR__ . '/../controllers/trajet_controle.php');



function ctrl_reserver_trajet() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();}

    if (!isset($_SESSION['uid'])) {
        header('Location: index.php?route=login');
        exit;
    }

    require_once (__DIR__ . '/../config/conf.php');
    global $pdo;

    require_once __DIR__ . '/../models/trajet_model.php';
    require_once __DIR__ . '/../models/ajouter_reservation.php';
    require(__DIR__ . '/../controllers/auth_ctrl.php');

    // GET: afficher la confirmation avant validation
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['trajet_id'])) {
        $trajet_id = (int) $_GET['trajet_id'];
        $trajet = find_trajet_by_id($pdo, $trajet_id);

        if (!$trajet) {
            echo " Trajet introuvable.";
            exit;
        }
        
        if ($trajet['nbr_place'] <= 0) {
           echo "<p>Plus aucune place disponible pour ce trajet.</p>";
        return;
    }

    if (ajouter_reservation($connex, $id_trajet, $id_passager)) {
        // Mise à jour des places disponibles
        decrementer_places($connex, $id_trajet);

        // Affichage de la confirmation
        require 'views/confirmation_reservation.php';
    } else {
        echo "<p>Erreur lors de la réservation.</p>";
    }
        require __DIR__ . '/../vues/confirmation_reservation.php';
        exit;
    }

    // POST: valider la réservation
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trajet_id'])) {
        $trajet_id = (int) $_POST['trajet_id'];
        $passager_id = $_SESSION['login'];

        // On peut vérifier ici si des places sont disponibles, si tu veux.

        if (ajouter_reservation($pdo, $trajet_id, $passager_id)) {
            // (Optionnel) décrémenter le nombre de places ici
            header('Location: index.php?route=reservation_success');
            exit;
        } else {
            echo " Erreur lors de la réservation. Veuillez réessayer.";
        }
    } else {
        echo " Requête invalide.";
    }
}

function ctrl_confirmation_succes() {
    require __DIR__ . '/../vues/confirmation_succes.php';
}
