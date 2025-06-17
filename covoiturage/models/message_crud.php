<?php

require_once 'Connexion.php';

class Message {
    public static function envoyer($trajetId, $expediteurId, $destinataireId, $contenu) {
        $pdo = Connexion::getInstance();
        $stmt = $pdo->prepare("INSERT INTO messages (trajet_id, expediteur_id, destinataire_id, contenu) VALUES (?, ?, ?, ?)");
        $stmt->execute([$trajetId, $expediteurId, $destinataireId, $contenu]);
    }

    public static function getMessages($trajetId, $utilisateurId) {
        $pdo = Connexion::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM messages 
            WHERE trajet_id = ? AND (expediteur_id = ? OR destinataire_id = ?)
            ORDER BY date_envoi ASC");
        $stmt->execute([$trajetId, $utilisateurId, $utilisateurId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function marquerCommeLu($messageId) {
        $pdo = Connexion::getInstance();
        $stmt = $pdo->prepare("UPDATE messages SET lu = 1 WHERE id = ?");
        $stmt->execute([$messageId]);
    }
}
