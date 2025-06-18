<?php

function confirmation_reservation_view(array $trajet) {
    echo "<h2>🚌 Confirmation de votre réservation</h2>";

    echo "<p><strong>Départ :</strong> {$trajet['lieuDepart']}</p>";
    echo "<p><strong>Arrivée :</strong> {$trajet['lieuArrivee']}</p>";
    echo "<p><strong>Date :</strong> " . date('d/m/Y', strtotime($trajet['date'])) . "</p>";
    echo "<p><strong>Heure :</strong> " . substr($trajet['heureDepart'], 0, 5) . "</p>";
    echo "<p><strong>Conducteur :</strong> {$trajet['conducteur_prenom']} {$trajet['conducteur_nom']}</p>";
    echo "<p><strong>Places restantes :</strong> {$trajet['nbr_place']}</p>";

    echo "<p style='color:blue;'>Voulez-vous  réserver ce trajet ?</p>";

    echo "<form method='post' action='index.php?route=reserver_trajet'>";
    echo "<input type='hidden' name='trajet_id' value='{$trajet['id']}'>";
    echo "<button type='submit' class='btn-reserver'> Confirmer</button>";
    echo " <a href='index.php' class='btn-annuler'> Annuler</a>";
    echo "</form>";
}

function mes_reservations_view(array $reservations) {
    echo "<h2>📋 Mes réservations</h2>";

    if (empty($reservations)) {
        echo "<p>Aucune réservation trouvée.</p>";
        return;
    }

    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    echo "<thead><tr>
            <th>Date</th><th>Heure</th><th>Départ</th><th>Arrivée</th><th>Participation</th><th>Statut</th>
          </tr></thead><tbody>";

    foreach ($reservations as $r) {
        echo "<tr>";
        echo "<td>{$r['date']}</td>";
        echo "<td>" . substr($r['heureDepart'], 0, 5) . "</td>";
        echo "<td>{$r['lieuDepart']}</td>";
        echo "<td>{$r['lieuArrivee']}</td>";
        echo "<td>{$r['participation']} €</td>";
        echo "<td>{$r['statut']}</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
    echo "<br><a href='index.php'>⬅ Retour à l'accueil</a>";
}
