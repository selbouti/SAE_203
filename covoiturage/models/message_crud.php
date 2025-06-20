<?php
require_once(__DIR__ . '/../config/conf.php');


 //Récupère l'ID du conducteur pour un trajet donné
 
function recuperer_id_conducteur($trajet_id) {
    global $pdo;

    
    $sql = "SELECT id_conducteur FROM trajet WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$trajet_id]);
    return $stmt->fetchColumn(); // fetch simple car un seul résultat attendu
}

function recuperer_id_passager($reservation_id) {
    global $pdo;

    
    $sql = "SELECT id_passager FROM reservation WHERE  id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$reservation_id]);
    return $stmt->fetchColumn();// fetch simple car un seul résultat attendu
}


// Vérifie si l'utilisateur est le conducteur du trajet

function is_conducteur($user_id, $conducteur_id) {
    global $pdo;

    if ($user_id === $conducteur_id) {
        return true;
    }
    return false;

// Vérifie si l'utilisateur est passager sur ce trajet

}
function is_passager($user_id, $trajet_id){
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservation WHERE id_trajet = ? AND id_passager = ?");
    $stmt->execute([$trajet_id, $user_id]);
    $is_passager = $stmt->fetchColumn();

    if ($is_passager ) {
        return true;
    }

    return false;
}


 // Ajoute un message dans la base de données
 
function add_message($trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message,$reservation_id) {
    global $pdo;
    $stmt = $pdo->prepare("
        INSERT INTO messages (trajet_id, expediteur_id, destinataire_id, contenu, type_message,reservation_id)
        VALUES (?, ?, ?, ?, ?,?)
    ");
    $stmt->execute([$trajet_id, $expediteur_id, $destinataire_id, $contenu, $type_message,$reservation_id]);
}


  //Récupère tous les messages d’un utilisateur liés à un trajet
 
function get_messages_for_user_and_trajet($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("
            SELECT 
            m.id,
            m.contenu,
            m.date_envoi,
            m.trajet_id,
            m.type_message,
            m.reservation_id,
            u.nom AS nom_expediteur
        FROM messages m
        JOIN etudiant u ON m.expediteur_id = u.id
        WHERE m.destinataire_id = ?
        ORDER BY m.date_envoi ASC
    ");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
