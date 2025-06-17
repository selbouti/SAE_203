<?php
// controllers/message_ctrl.php
require_once(__DIR__ . '/../models/message_model.php');
require_once(__DIR__ . '/../config/conf.php');

function has_access_to_message($user_id, $trajet_id, $destinataire_id) {
    global $pdo;

    // Vérifie si l'utilisateur est le conducteur du trajet
    $stmt = $pdo->prepare("SELECT id_conducteur FROM trajet WHERE id = ?");
    $stmt->execute([$trajet_id]);
    $conducteur = $stmt->fetchColumn();

    if ($user_id === $conducteur) {
        return true;
    }

    // Vérifie si l'utilisateur est passager sur ce trajet
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservation WHERE id_trajet = ? AND id_passager = ?");
    $stmt->execute([$trajet_id, $user_id]);
    $is_passager = $stmt->fetchColumn();

    if ($is_passager && $destinataire_id === $conducteur) {
        return true;
    }

    return false;
}

function add_message_ctrl() {
    session_start();
    global $pdo;

    $trajet_id = $_POST['trajet_id'] ?? null;
    $destinataire_id = $_POST['destinataire_id'] ?? null;
    $contenu = $_POST['contenu'] ?? '';
    $type_message = $_POST['type_message'] ?? 'AvantReservation';
    $expediteur_id = $_SESSION['uid'] ?? null;

    if (!$trajet_id || !$destinataire_id || !$expediteur_id || !$contenu) {
        echo "<p>Paramètres manquants.</p>";
        return;
    }

    if (has_access_to_message($expediteur_id, $trajet_id, $destinataire_id)) {
        add_message($trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message);
        header("Location: index.php?route=list_messages&trajet_id=$trajet_id");
        exit;
    } else {
        echo "<p>Accès refusé.</p>";
    }
}

function list_messages_ctrl() {
    session_start();
    $user_id = $_SESSION['uid'] ?? null;
    $trajet_id = $_GET['trajet_id'] ?? null;

    if (!$user_id || !$trajet_id) {
        echo "<p>Paramètres manquants.</p>";
        return;
    }

    $messages = get_messages_for_user_and_trajet($trajet_id, $user_id);
    require(__DIR__ . '/../views/messages_view.php');
}
