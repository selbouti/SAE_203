<?php
function getTrajetsDuJour($connexion) {
    $sql = "SELECT 
                t.id,
                t.lieuDepart,
                t.points_intermediaires,
                t.heureDepart,
                t.heureArrivee,
                t.nbr_place,
                e.nom AS nom_conducteur
            FROM trajet t
            LEFT JOIN etudiant e ON t.id_conducteur = e.id
            ORDER BY t.heureDepart";

    $result = $connexion->query($sql);
        
    if ($result === false) {
    
        print_r($connexion->errorInfo());
        return [];
    }

    return $result->fetchAll(PDO::FETCH_ASSOC);
    }
