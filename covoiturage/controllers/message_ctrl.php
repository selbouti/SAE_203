<?php

require_once 'modele/Message.php';

class MessageController {
    public function envoyer() {
        if (isset($_POST['trajet_id'], $_POST['expediteur_id'], $_POST['destinataire_id'], $_POST['contenu'])) {
            Message::envoyer($_POST['trajet_id'], $_POST['expediteur_id'], $_POST['destinataire_id'], $_POST['contenu']);
            header('Location: index.php?action=messages&trajet_id=' . $_POST['trajet_id']);
        }
    }

    public function afficherMessages() {
        if (isset($_GET['trajet_id'], $_GET['utilisateur_id'])) {
            $messages = Message::getMessages($_GET['trajet_id'], $_GET['utilisateur_id']);
            include 'vue/messages.php';
        }
    }
}
