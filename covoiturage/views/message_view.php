<?php
require_once(__DIR__ . '/../controllers/auth_ctrl.php');

function messages_view($messages) {
    $user_id = $_SESSION['login'];
    echo "<div>";

    foreach ($messages as $msg) {
        // Sécurité : vérifie que les clés existent
        $expediteur_id = $msg['expediteur_id'] ?? null;
        $contenu = htmlspecialchars($msg['contenu'] ?? '');
        $date_envoi = $msg['date_envoi'] ?? '';
        $type_message = htmlspecialchars($msg['type_message'] ?? 'Inconnu');
        $trajet_id = $msg['trajet_id'] ?? null;
        $nom_expediteur = htmlspecialchars($msg['prenom_expediteur'] ?? '') . " " . htmlspecialchars($msg['nom_expediteur'] ?? '');

        $isMe = $expediteur_id === $user_id;

        echo "<div style='margin: 5px; padding: 10px; background-color:" . ($isMe ? '#ddf' : '#eee') . "'>";
        echo "<strong>" . ($isMe ? 'Moi' : $nom_expediteur) . " :</strong> $contenu";
        echo "<br><small>$date_envoi - $type_message</small>";
        echo "<br><small>le trajet numero: $trajet_id</small>";
        echo "</div>";

        //repondre
        echo '<form action="index.php?route=message" method="post" style="display:inline; margin-left:5px;">';
        echo "<input type='hidden' name='reservation_id' value='" . htmlspecialchars($msg['reservation_id']) . "'>";
        echo "<input type='hidden' name='trajet_id' value='" . htmlspecialchars($msg['trajet_id']) . "'>";
        echo "<button type='submit' style='margin-top: 5px; background-color: #4CAF50; color: white; border: none; padding: 5px 10px; border-radius: 5px;'>Répondre</button>";
        echo "</form>";
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