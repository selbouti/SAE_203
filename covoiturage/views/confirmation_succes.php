<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réservation réussie</title>
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
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        h1 {
            color: #27ae60;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin-bottom: 30px;
            color: #333;
        }

        a {
            display: inline-block;
            margin: 10px 15px;
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: red;
        }

        @media (max-width: 500px) {
            .container {
                padding: 30px 20px;
            }

            a {
                display: block;
                margin: 10px auto;
            }
        }
    </style>
</head>
<body>
    <div>
        <h1>✅ Réservation réussie !</h1>
        <p>Votre réservation a bien été prise en compte.</p>
        <a href="index.php?route=mes_reservations">Voir mes réservations</a>
        <a href="index.php">Retour à l'accueil</a>
    </div>
</body>
</html>
