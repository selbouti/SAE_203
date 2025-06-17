<?php
require_once(__DIR__ . '/../config/conf.php');

function add_message($trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO messages (trajet_id, expediteur_id, destinataire_id, contenu, type_message) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message]);
}

function get_messages_for_user_and_trajet($trajet_id, $user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT * FROM messages 
        WHERE trajet_id = ? 
          AND (expediteur_id = ? OR destinataire_id = ?)
        ORDER BY date_envoi ASC
    ");
    $stmt->execute([$trajet_id, $user_id, $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
