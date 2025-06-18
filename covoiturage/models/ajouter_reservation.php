<?php
function ajouter_reservation(PDO $connex, int $id_trajet, string $id_passager) {
    $req = "INSERT INTO reservation (id_trajet, id_passager, dateReservation, statut)
            VALUES (:id_trajet, :id_passager, NOW(), 'EnAttente')";

    $prep = $connex->prepare($req);
    $prep->bindValue(':id_trajet', $id_trajet, PDO::PARAM_INT);
    $prep->bindValue(':id_passager', $id_passager, PDO::PARAM_STR); 

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

function get_reservations_by_passager(PDO $pdo, string $passager_id): array {
    $req = "SELECT r.*, t.lieuDepart, t.lieuArrivee, t.date, t.heureDepart, t.typeTrajet, t.participation
            FROM reservation r
            JOIN trajet t ON r.id_trajet = t.id
            WHERE r.id_passager = :id
            ORDER BY t.date DESC";

    $prep = $pdo->prepare($req);
    $prep->bindValue(':id', $passager_id, PDO::PARAM_STR);
    $prep->execute();

    $reservations = $prep->fetchAll(PDO::FETCH_ASSOC);
    $prep->closeCursor();

    return $reservations;
}

function decrementer_places(PDO $pdo, int $trajet_id): bool {
    $sql = "UPDATE trajet SET nbr_place = nbr_place - 1 WHERE id = :id AND nbr_place > 0";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $trajet_id, PDO::PARAM_INT);
    $success = $stmt->execute();
    $stmt->closeCursor();

    return $success;
}



function get_reservations_par_trajet(PDO $pdo, int $trajet_id): array {
    $requete = "
        SELECT r.*, e.nom, e.prenom
        FROM reservation r
        JOIN etudiant e ON r.id_passager = e.id
        WHERE r.id_trajet = :trajet_id
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->bindValue(':trajet_id', $trajet_id, PDO::PARAM_INT);
    $stmt->execute();

    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $reservations;
}


function changer_statut_reservation(PDO $pdo, int $reservation_id, string $statut): bool {
    $requete = "
        UPDATE reservation
        SET statut = :statut
        WHERE id = :id
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->bindValue(':statut', $statut, PDO::PARAM_STR);
    $stmt->bindValue(':id', $reservation_id, PDO::PARAM_INT);

    $resultat = $stmt->execute();
    $stmt->closeCursor();

    return $resultat;
}


function get_trajets_par_conducteur(PDO $pdo, string $conducteur_id): array {
    $sql = "
        SELECT *
        FROM trajet
        WHERE id_conducteur = :id_conducteur
        ORDER BY date DESC, heureDepart DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id_conducteur', $conducteur_id, PDO::PARAM_STR);
    $stmt->execute();

    $trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $trajets;
}


