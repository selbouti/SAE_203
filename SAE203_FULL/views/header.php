<?php 
session_start()
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appli procédures</title>
    <link rel="stylesheet" type="text/css" href="css/global.css" />
</head>

<body>
<header>
	<a href="index.php"><img src="images/idea.png" alt="Retour vers la page d'accueil" /></a>
	<h1>Application "Procédures"</h1>
	<h2>Base de données de résolution de pannes</h2>
	<nav>
    	<ul>
    		<li><a href="index.php?route=families">Familles</a></li>
    		<li><a href="index.php?route=add_equipment">Ajout équipement</a></li>
    		<li><a href="index.php?route=contact">Contact</a></li>
    	</ul>
	</nav>
</header>
<a id="logout" href="index.php?route=logout">Déconnexion</a>

<?php 
if (!empty($_SESSION['notification'])) {
    echo '<div id="notification">' . $_SESSION['notification'] . '</div>';
    unset($_SESSION['notification']);
}
?>
<article>
