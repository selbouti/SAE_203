<?php
 require_once __DIR__ . '/../config/conf.php';
 require_once __DIR__ . '/../crud/crud_reservation.php';
function ctrl_reserver_trajet() {
    #if (!isset($_SESSION['uid'])) {
    #    header('Location: index.php?action=connexion');
    #    exit;
    #}

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trajet_id'])) {
        require_once __DIR__ . '/../config/conf.php';
        require_once __DIR__ . '/../crud/crud_reservation.php';

        $trajet_id = (int)$_POST['trajet_id'];
        $passager_id = $_SESSION['user']['id'];

        if (ajouter_reservation($pdo, $trajet_id, $passager_id)) {
            echo "Réservation effectuée avec succès.";
            // Ou rediriger vers mes réservations :
            // header('Location: index.php?action=mes_reservations');
        } else {
            echo "Erreur lors de la réservation.";
        }
    } else {
        echo "Requête invalide.";
    }
}