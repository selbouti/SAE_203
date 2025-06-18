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

    echo <<<HTML
    <form method="POST" action="index.php?route=send_message">
        <input type="hidden" name="trajet_id" value="$trajet_id">
        <input type="hidden" name="destinataire_id" value="(À définir dynamiquement)">
        <input type="hidden" name="type_message" value="AvantReservation">
        <textarea name="contenu" placeholder="Votre message..." required></textarea><br>
        <button type="submit">Envoyer</button>
    </form>
HTML;
}
messages_view($messages, $trajet_id);
