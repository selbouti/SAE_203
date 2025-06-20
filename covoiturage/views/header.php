<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Covoiturage Étudiant - IUT Châtellerault</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="/dev/SAE_203/covoiturage/css/style.css">
    <link rel="stylesheet" href="/dev/SAE_203/covoiturage/css/global.css">
    <link rel="stylesheet" href="/dev/SAE_203/covoiturage/css/prjet.css">
</head>
<body>
<header>
    <a href="index.php"><img src="/dev/SAE_203/covoiturage/images/idea.png" alt="Accueil" style="height: 50px;" /></a>
    <div>
        <h1>Application de Covoiturage Étudiant</h1>
        <h2>IUT de Châtellerault - Département R&T</h2>
    </div>
</header>

<?php 
if (!empty($_SESSION['notification'])) {
    echo '<div id="notification">' . $_SESSION['notification'] . '</div>';
    unset($_SESSION['notification']);
}
?>

<main>
