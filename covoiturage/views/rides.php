<?php
require('views/header.php');
require_once('models/crud.php');

$rides = getAllRides();
?>

<main class="form-container">
    <div class="card">
        <h2>Trajets disponibles</h2>

        <?php foreach ($rides as $ride): ?>
            <div style="border-bottom:1px solid #ccc; padding:10px 0;">
                <strong>Départ :</strong> <?= htmlspecialchars($ride['lieuDepart']) ?><br>
                <strong>Date :</strong> <?= htmlspecialchars($ride['date']) ?><br>
                <strong>Heure de départ :</strong> <?= htmlspecialchars($ride['heureDepart']) ?><br>
                <strong>Lieu d’arrivée :</strong> <?= htmlspecialchars($ride['lieuArrivee']) ?><br>
                <strong>Heure d’arrivée :</strong> <?= htmlspecialchars($ride['heureArrivee']) ?><br>
                <strong>Participation :</strong> <?= htmlspecialchars($ride['participation']) ?> €<br>
                <strong>Points intermédiaires :</strong> <?= htmlspecialchars($ride['points_intermediaires']) ?><br>
                <strong>Type :</strong> <?= htmlspecialchars($ride['typeTrajet']) ?><br>
                <strong>Places :</strong> <?= htmlspecialchars($ride['nbr_place']) ?><br>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require('views/footer.php'); ?>
