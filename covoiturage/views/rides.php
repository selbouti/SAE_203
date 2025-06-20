<?php
require_once('models/crud.php');

$rides = getAllRides();
?>

<main class="form-container">
    <div class="card">
        <h2>Trajets disponibles</h2>

        <?php foreach ($rides as $ride): ?>
            <div style="border-bottom:1px solid #ccc; padding:10px 0;">
                <strong>Départ :</strong> <?= $ride['lieuDepart'] ?><br>
                <strong>Date :</strong> <?= $ride['date'] ?><br>
                <strong>Heure de départ :</strong> <?= $ride['heureDepart'] ?><br>
                <strong>Lieu d’arrivée :</strong> <?= $ride['lieuArrivee'] ?><br>
                <strong>Heure d’arrivée :</strong> <?= $ride['heureArrivee'] ?><br>
                <strong>Participation :</strong> <?= $ride['participation'] ?> €<br>
                <strong>Points intermédiaires :</strong> <?= $ride['points_intermediaires'] ?><br>
                <strong>Type :</strong> <?= $ride['typeTrajet'] ?><br>
                <strong>Places :</strong> <?= $ride['nbr_place'] ?><br>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require('views/footer.php'); ?>
