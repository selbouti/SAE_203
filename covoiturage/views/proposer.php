<?php
require('header.php');
?>

<div class="navbar">
    <div class="navbar-left">
        <span class="logo">Lalacar</span>
    </div>
    <div class="search-icon">🔍</div>
    <button class="logout-btn">Se déconnecter</button>
</div>

<div class="logo-banner">
    <img src="images/logos-meta-20.png" alt="Logo" style="max-height: 80px; display: block; margin: 20px auto;">
</div>

<div class="form-container">
    <div class="card">
        <h2>Proposer un covoiturage</h2>
        <form method="post" action="index.php?route=rides">
            <input type="text" name="lieuDepart" placeholder="Lieu de départ" required>
            <input type="text" name="gpsDepart" placeholder="Coordonnées GPS de départ">
            <input type="text" name="lieuArrivee" placeholder="Lieu d’arrivée" required>
            <input type="text" name="gpsArrivee" placeholder="Coordonnées GPS d’arrivée">
            <input type="date" name="date" required>
            <input type="time" name="heureDepart" placeholder="Heure de départ" required>
            <input type="time" name="heureArrivee" placeholder="Heure d’arrivée" required>
            <input type="number" name="participation" step="0.01" placeholder="Participation (€)" required>
            <input type="number" name="nbr_place" placeholder="Nombre de places" required>
            <select name="typeTrajet" required>
                <option value="aller_simple">Aller simple</option>
                <option value="retour_simple">Retour simple</option>
                <option value="aller_retour">Aller / Retour</option>
            </select>
            <input type="text" name="points_intermediaires" placeholder="Points intermédiaires (séparés par ,)">
            <button type="submit">Valider le trajet</button>
        </form>
    </div>
</div>

<?php
require('footer.php');
?>
