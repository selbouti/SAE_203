<?php
 require(__DIR__ . '/../controllers/auth_ctrl.php');
function messages_view($messages, $trajet_id) {
    $user_id = $_SESSION['login'];
    echo "<h2>Messagerie pour le trajet $trajet_id</h2>";
    echo "<div>";
    foreach ($messages as $msg) {
        $isMe = $msg['expediteur_id'] === $user_id;
        echo "<div style='margin: 5px; padding: 10px; background-color:" . ($isMe ? '#ddf' : '#eee') . "'>";
        echo "<strong>" . ($isMe ? 'Moi' : 'Autre') . " :</strong> " . htmlspecialchars($msg['contenu']);
        echo "<br><small>" . $msg['date_envoi'] . " - " . $msg['type_message'] . "</small>";
        echo "</div>";
    }
    echo "</div>";
}
function afficher_formulaire_message($trajet_id, $type_message = "AvantReservation") {
    echo <<<HTML
    <h2>Envoyer un message</h2>
    <form method="POST" action="index.php?route=send_message">
        <input type="hidden" name="trajet_id" value="$trajet_id">
        <input type="hidden" name="type_message" value="$type_message">

        <label for="contenu">Message :</label><br>
        <textarea name="contenu" id="contenu" rows="4" cols="50" placeholder="Votre message..." required></textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
HTML;
}