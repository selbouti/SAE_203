<h2>Messagerie du trajet #<?= htmlspecialchars($_GET['trajet_id']) ?></h2>

<?php foreach ($messages as $msg): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
        <strong><?= $msg['expediteur_id'] == $_GET['utilisateur_id'] ? 'Vous' : 'Utilisateur ' . $msg['expediteur_id'] ?> :</strong><br>
        <?= htmlspecialchars($msg['contenu']) ?><br>
        <small>Envoyé le <?= $msg['date_envoi'] ?></small>
    </div>
<?php endforeach; ?>

<form action="index.php?action=envoyer_message" method="post">
    <input type="hidden" name="trajet_id" value="<?= $_GET['trajet_id'] ?>">
    <input type="hidden" name="expediteur_id" value="<?= $_GET['utilisateur_id'] ?>">
    <input type="hidden" name="destinataire_id" value="ID_A_REMPLACER"><!-- À adapter dynamiquement -->

    <textarea name="contenu" required placeholder="Votre message..."></textarea><br>
    <button type="submit">Envoyer</button>
</form>
