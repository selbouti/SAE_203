<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmer votre réservation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .btn-reserver, .btn-annuler {
            display: inline-block;
            margin: 10px 10px 0 0;
            padding: 12px 20px;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
        }

        .btn-reserver {
            background-color: #27ae60;
            color: white;
        }

        .btn-reserver:hover {
            background-color: #219150;
        }

        .btn-annuler {
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
        }

        .btn-annuler:hover {
            background-color: #c0392b;
        }

        @media (max-width: 500px) {
            .container {
                padding: 30px 20px;
            }

            .btn-reserver, .btn-annuler {
                display: block;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirmer votre réservation</h1>
        <p><strong>Départ :</strong> <?= htmlspecialchars($trajet['lieuDepart']) ?></p>
        <p><strong>Arrivée :</strong> <?= htmlspecialchars($trajet['lieuArrivee']) ?></p>
        <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($trajet['date'])) ?></p>
        <p><strong>Heure :</strong> <?= substr($trajet['heureDepart'], 0, 5) ?></p>
        <p><strong>Conducteur :</strong> <?= htmlspecialchars($trajet['conducteur_prenom'] . ' ' . $trajet['conducteur_nom']) ?></p>
        <p><strong>Places disponibles :</strong> <?= $trajet['nbr_place'] ?></p>

        <?php if ($trajet['nbr_place'] > 0): ?>
            <form method="post" action="index.php?route=reserver_trajet">
                <input type="hidden" name="trajet_id" value="<?= $trajet['id'] ?>">
                <button type="submit" class="btn-reserver">✅ Confirmer la réservation</button>
                <a href="index.php" class="btn-annuler">❌ Annuler</a>
            </form>
        <?php else: ?>
            <p><strong style="color: red;">Plus de places disponibles pour ce trajet.</strong></p>
            <a href="index.php" class="btn-annuler">Retour à l'accueil</a>
        <?php endif; ?>
    </div>
</body>
</html>
