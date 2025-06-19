<?php


require_once(__DIR__ . '/../models/trajet_model.php');

function ctrl_reserver_trajet() {
    require_once(__DIR__ . '/../models/ajouter_reservation.php');
    require_once(__DIR__ . '/../config/conf.php');
    require_once(__DIR__ . '/../views/confirmation_reservation.php');
    
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

        confirmation_reservation_view($trajet);
        return;
    }

    // ----- valider la réservation -----
   // ----- POST : valider la réservation -----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trajet_id'])) {
    $trajet_id = (int) $_POST['trajet_id'];
    $passager_id = $_SESSION['login'];


    $type_trajet = $trajet['typeTrajet'];

    if (deja_reserve_ce_type_aujourdhui($pdo, $passager_id, $type_trajet)) {
          erreur_reservation_view($type_trajet);
        exit;
    }

    if (ajouter_reservation($pdo, $trajet_id, $passager_id)) {
        header('Location: index.php?route=reservation_success');
        exit;
    } 
}



function ctrl_mes_reservations() {
    require_once(__DIR__ . '/../config/conf.php');
    require_once(__DIR__ . '/../models/ajouter_reservation.php');
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
   require_once(__DIR__ . '/../views/confirmation_succes.php');
}



// --------- coté conducteur  -----------





function ctrl_mes_trajets() {
    require_once(__DIR__ . '/../config/conf.php');
    require_once(__DIR__ . '/../models/ajouter_reservation.php');
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
    require_once(__DIR__ . '/../config/conf.php');
    require_once(__DIR__ . '/../models/ajouter_reservation.php');
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
    require_once(__DIR__ . '/../config/conf.php');
    require_once(__DIR__ . '/../models/ajouter_reservation.php');
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


