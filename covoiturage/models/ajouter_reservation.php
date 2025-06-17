<?php

function ajouter_reservation(PDO $connex, int $id_trajet, int $id_passager) {
    $req = "INSERT INTO reservation (id_trajet, id_passager, dateReservation, statut)
            VALUES (:id_trajet, :id_passager, NOW(), 'en_attente')";
    
    $prep = $connex->prepare($req);
    $prep->bindValue(':id_trajet', $id_trajet, PDO::PARAM_INT);
    $prep->bindValue(':id_passager', $id_passager, PDO::PARAM_INT);
    
    $result = $prep->execute();
    $prep->closeCursor();
    
    return $result;
}


function find_trajet_by_id(PDO $pdo, int $id) {
    $req = "SELECT t.*, u.nom AS conducteur_nom, u.prenom AS conducteur_prenom 
            FROM trajet t 
            JOIN utilisateur u ON t.id_conducteur = u.id 
            WHERE t.id = :id";

    $prep = $pdo->prepare($req);
    $prep->bindValue(':id', $id, PDO::PARAM_INT);
    $prep->execute();

    $trajet = $prep->fetch(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return $trajet;
}

