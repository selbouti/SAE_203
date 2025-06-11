<?php 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Appli procédures</title>
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/prjet.css" />
</head>
<body>
<header>
    <a href="index.php"><img src="images/idea.png" alt="Retour vers la page d'accueil" /></a>
    <h1>Application "Procédures"</h1>
    <h2>Base de données de résolution de pannes</h2>
</header>
<a id="logout" href="index.php?route=logout">Déconnexion</a>

<?php 
if (!empty($_SESSION['notification'])) {
    echo '<div id="notification">' . $_SESSION['notification'] . '</div>';
    unset($_SESSION['notification']);
}
?>

<article>
