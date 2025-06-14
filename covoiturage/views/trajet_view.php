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
    // Inclusion du contrôleur qui fournit la variable $trajets
    require_once __DIR__ . '/../controllers/trajet_controle.php';

    // Fonction d'affichage des trajets
    function affiche_trajets($trajets) {
        
        foreach ($trajets as $trajet) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($trajet['heureDepart']) . "</td>";
            echo "<td>" . htmlspecialchars($trajet['heureArrivee']) . "</td>";
            echo "<td>" . htmlspecialchars($trajet['prenom_conducteur'] . ' ' . $trajet['nom_conducteur']) . "</td>";
            echo "<td>" . htmlspecialchars($trajet['lieuDepart']) . "</td>";
            echo "<td>" . htmlspecialchars($trajet['points_intermediaires'] ?? 'Aucun') . "</td>";
            echo "<td>" . htmlspecialchars($trajet['nbr_place'] ?? '') . "</td>";
            echo "</tr>";
        }
    }
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
            <th>Action</th> <!-- Colonne pour le bouton -->
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($trajets) && is_array($trajets) && count($trajets) > 0) {
            foreach ($trajets as $trajet) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($trajet['heureDepart']) . "</td>";
                echo "<td>" . htmlspecialchars($trajet['heureArrivee']) . "</td>";
                echo "<td>" . htmlspecialchars($trajet['prenom_conducteur'] . ' ' . $trajet['nom_conducteur']) . "</td>";
                echo "<td>" . htmlspecialchars($trajet['lieuDepart']) . "</td>";
                echo "<td>" . htmlspecialchars($trajet['points_intermediaires'] ?? 'Aucun') . "</td>";
                echo "<td>" . htmlspecialchars($trajet['nbr_place'] ?? '') . "</td>";
                echo "<td>";
                // Formulaire de réservation pour ce trajet
                ?>
                <form action="index.php?route=reserver_trajet" method="post" style="margin:0;">
                    <input type="hidden" name="trajet_id" value="<?= htmlspecialchars($trajet['id']) ?>">
                    <button type="submit">Réserver</button>
                </form>
                <?php
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
