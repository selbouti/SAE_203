<?php function formulaire_view() { ?>
<!DOCTYPE html>
<html lang="fr">
<head>
 <meta charset="utf-8" />
 <title>Fiche d'inscription</title>
 <link rel="stylesheet" type="text/css" href="css/connexion.css" />
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
 <div class="contactez-nous">
 <img src="assets/images/logo.png" alt="Logo Université de Poitiers" class="logo-form" />
 <h1>Fiche d'inscription</h1>
 <p>
 Prêt(e) à rejoindre la communauté du covoiturage universitaire ? Remplis
 ce formulaire pour t’inscrire et commencer à partager tes trajets !
 </p>
 <form action="index.php?route=submit_form" method="post">

<label for="sujet">Rôle</label>
<select name="sujet" id="sujet" required>
<option value="" disabled selected hidden>Choisissez votre rôle</option>
<option value="conducteur">Conducteur</option>
<option value="utilisateur">Transporté</option>
</select>

<label for="adresse">Adresse complète</label>
<input type="text" id="adresse" name="adresse" placeholder="Ex : 21 rue de Thuré" required />



<label for="email">Adresse e-mail</label>
<input type="email" id="email" name="email" placeholder="Ex : prenom.nom@etu.univ-poitiers.fr" required />

<label for="gps">Coordonnée GPS</label>
<input type="text" id="gps" name="gps" placeholder="Ex : 46.5802, 0.3404" required />

<label for="departement">Département</label>
<select name="departement" id="departement" required>
<option value="" disabled selected hidden>Choisissez votre département</option>
<option value="rt">Réseau Télécom (RT)</option>
<option value="mp">Mesures physiques (MP)</option>
<option value="tc">Techniques de commercialisation (TC)</option>
</select>

<label for="niveau">Niveau</label>
<select name="n
