<?php

function ajouter_reservation(PDO $connex, int $id_trajet, int $id_passager): bool {
    $req = "INSERT INTO reservation (id_trajet, id_passager, dateReservation, statut)
            VALUES (?, ?, NOW(), 'en_attente')";
    $stmt = $connex->prepare($req);
    return $stmt->execute([$id_trajet, $id_passager]);
}


function find_trajet_by_id(PDO $pdo, int $id) {
    $stmt = $pdo->prepare("SELECT t.*, u.nom AS conducteur_nom, u.prenom AS conducteur_prenom 
                           FROM trajet t 
                           JOIN utilisateur u ON t.id_conducteur = u.id 
                           WHERE t.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

