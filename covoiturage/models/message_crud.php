<?php
require_once(__DIR__ . '/../config/conf.php');

/**
 * Récupère l'ID du conducteur pour un trajet donné
 */
function recuperer_donnees($trajet_id) {
    global $pdo;

    // Correction : enlever la virgule après id_conducteur et utiliser des requêtes préparées
    $sql = "SELECT id_conducteur FROM trajet WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$trajet_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // fetch simple car un seul résultat attendu
}

/**
 * Ajoute un message dans la base de données
 */
function add_message($trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message) {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO messages (trajet_id, expediteur_id, destinataire_id, contenu, type_message)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message]);
}

/**
 * Récupère tous les messages d’un utilisateur liés à un trajet
 */
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
