<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Trajets du jour</title>
    <link rel="stylesheet" href="/dev/SAE_203/covoiturage/css/trajet.css">
</head>
<body>
    <h1>Trajets disponibles aujourd’hui</h1>

    <?php
    // Inclusion du contrôleur
    //require_once __DIR__ . '/../controllers/trajet_controle.php';
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>Heure départ</th>
                <th>Heure arrivée</th>
                <th>Conducteur</th>
                <th>Lieu de départ</th>
                <th>Points intermédiaires</th>
                <th>Places restantes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (isset($trajets) && is_array($trajets) && count($trajets) > 0) {
            foreach ($trajets as $trajet) {
                echo "<tr>";
                echo "<td>" . $trajet['heureDepart'] . "</td>";
                echo "<td>" . $trajet['heureArrivee'] . "</td>";
                echo "<td>" . $trajet['nom_conducteur'] . "</td>";
                echo "<td>" . $trajet['lieuDepart'] . "</td>";
                echo "<td>" . ($trajet['points_intermediaires'] ?? 'Aucun') . "</td>";
                echo "<td>" . ($trajet['nbr_place'] ?? '') . "</td>";

                echo "<td>";

                // Réserver
                echo '<form action="index.php?route=reserver_trajet" method="GET" style="display:inline;">';
                echo '<input type="hidden" name="trajet_id" value="' . $trajet['id'] . '">';
                echo '<button type="submit">Réserver</button>';
                echo '</form>';

                // Envoyer message
                echo '<form action="index.php?route=message" method="post" style="display:inline; margin-left:5px;">';
                echo '<input type="hidden" name="trajet_id" value="' . $trajet['id'] . '">';
                echo '<input type="hidden" name="type_message" value="' . 'AvantReservation' . '">';
                echo '<button type="submit">Envoyer un message</button>';
                echo '</form>';

                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr><td colspan="7">Aucun trajet disponible pour aujourd’hui.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</body>
</html>