<?php

require_once(__DIR__ . '/../config/conf.php');
require_once(__DIR__ . '/../models/trajet_model.php');
require_once(__DIR__ . '/../models/ajouter_reservation.php');
require_once(__DIR__ . '/../views/confirmation_reservation.php');

function ctrl_reserver_trajet() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['uid'])) {
        header('Location: index.php?route=login');
        exit;
    }

    $pdo = connection();

    // -----  afficher la confirmation -----
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['trajet_id'])) {
        $trajet_id = (int) $_GET['trajet_id'];
        $trajet = find_trajet_by_id($pdo, $trajet_id);

        if (!$trajet) {
            echo "Trajet introuvable.";
            exit;
        }

        confirmation_reservation_view($trajet);
        return;
    }

    // ----- valider la réservation -----
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trajet_id'])) {
        $trajet_id = (int) $_POST['trajet_id'];
        $passager_id = $_SESSION['login'];

        $trajet = find_trajet_by_id($pdo, $trajet_id);
        if (!$trajet) {
            echo "Erreur : trajet inexistant.";
            exit;
        }
        if (ajouter_reservation($pdo, $trajet_id, $passager_id)) {
            header('Location: index.php?route=reservation_success');
            exit;
        } else {
            echo "Erreur lors de la réservation.";
        }
    } else {
        echo "Requête invalide.";
    }
}

function ctrl_mes_reservations() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['login'])) {
        header('Location: index.php?route=login');
        exit;
    }

    $pdo = connection();
    $reservations = get_reservations_by_passager($pdo, $_SESSION['user']['id']);

    mes_reservations_view($reservations);
}

function ctrl_confirmation_succes() {
    echo "<h2> Réservation confirmée avec succès !</h2>";
    echo "<a href='index.php'>Retour à l'accueil</a>";
}



// --------- coté conducteur  -----------





function ctrl_mes_trajets() {
    session_start();

    if (!isset($_SESSION['uid'])) {
        header('Location: index.php?route=login');
        exit;
    }

    $pdo = connection();
    $conducteur_id = $_SESSION['login'];

    $trajets = get_trajets_par_conducteur($pdo, $conducteur_id);
    mes_trajets_view($trajets);
}

function ctrl_reservations_trajet() {
    session_start();

    if (!isset($_SESSION['uid']) || !isset($_GET['trajet_id'])) {
        header('Location: index.php?route=login');
        exit;
    }

    $pdo = connection();
    $trajet_id = (int) $_GET['trajet_id'];

    $reservations = get_reservations_par_trajet($pdo, $trajet_id);
    reservations_par_trajet_view($trajet_id, $reservations);
}

function ctrl_changer_statut() {
    session_start();

    if (!isset($_SESSION['uid']) || !isset($_POST['id']) || !isset($_POST['statut']) || !isset($_POST['trajet_id'])) {
        header('Location: index.php?route=login');
        exit;
    }

    $pdo = connection();

    $reservation_id = (int) $_POST['id'];
    $trajet_id = (int) $_POST['trajet_id'];
    $statut = $_POST['statut'];

    //  Mise à jour du statut de la réservation
    if (changer_statut_reservation($pdo, $reservation_id, $statut)) {
        //  Si acceptée, on décrémente les places
        if ($statut === 'Acceptee') {
            decrementer_places($pdo, $trajet_id);
        }
    }

    //  Redirection vers la page des réservations de ce trajet
    header("Location: index.php?route=voir_reservations&trajet_id=" . $trajet_id);
    exit;
}


