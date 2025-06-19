<?php

function confirmation_reservation_view(array $trajet) {
    echo "<h2> Confirmation de votre réservation</h2>";

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



function erreur_reservation_view(string $type_trajet) {
    require('views/header.php');

    echo "<h2 style='color:red;'>❌ Réservation non autorisée</h2>";
    echo "<p>Vous avez déjà réservé un trajet <strong>$type_trajet</strong> aujourd'hui.</p>";
    echo "<p>Un seul trajet <em>Aller</em> et un seul trajet <em>Retour</em> sont autorisés par jour.</p>";
    echo "<a href='index.php'>⬅ Retour à l'accueil</a>";

    require('views/footer.php');
}


function mes_reservations_view(array $reservations) {
    echo "<h2> Mes réservations</h2>";

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



//----- coté conducteur -----

function mes_trajets_view(array $trajets) {
    require('views/header.php');
    echo "<h2>\ud83d\ude9c Mes trajets publi\u00e9s</h2>";

    if (empty($trajets)) {
        echo "<p>Aucun trajet publi\u00e9 pour le moment.</p>";
    } else {
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>Départ</th><th>Arrivée</th><th>Date</th><th>Actions</th></tr>";
        foreach ($trajets as $t) {
            echo "<tr>";
            echo "<td>{$t['lieuDepart']}</td>";
            echo "<td>{$t['lieuArrivee']}</td>";
            echo "<td>" . date('d/m/Y', strtotime($t['date'])) . "</td>";
            echo "<td><a href='index.php?route=voir_reservations&trajet_id={$t['id']}'>Voir les réservations</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    require('views/footer.php');
}

function reservations_par_trajet_view(int $trajet_id, array $reservations) {
    require('views/header.php');
    echo "<h2> Reservations pour le trajet $trajet_id</h2>";

    if (empty($reservations)) {
        echo "<p>Aucune r\u00e9servation pour ce trajet.</p>";
    } else {
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>Nom</th><th>Prénom</th><th>Statut</th><th>Action</th></tr>";
        foreach ($reservations as $r) {
            echo "<tr>";
            echo "<td>{$r['nom']}</td>";
            echo "<td>{$r['prenom']}</td>";
            echo "<td>{$r['statut']}</td>";
            echo "<td>";
            if ($r['statut'] === 'EnAttente') {
                echo "<form method='post' action='index.php?route=changer_statut' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='{ $r['id'] }'>";
                echo "<input type='hidden' name='trajet_id' value='$trajet_id'>";
                echo "<button type='submit' name='statut' value='Acceptee'>Accepter</button>";
                echo "<button type='submit' name='statut' value='Refusee'>Refuser</button>";
                echo "</form>";
            } else {
                echo "--";
            }
            echo "</td></tr>";
        }
        echo "</table>";
    }

    echo "<p><a href='index.php?route=mes_trajets'> Retour à mes trajets</a></p>";
    require('views/footer.php');
}
