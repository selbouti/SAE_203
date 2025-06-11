<?php
require_once(__DIR__ . '/../config/conf.php');
require_once(__DIR__ . '/../models/trajet_model.php');
$trajets = getTrajetsDuJour($pdo);
function decrementer_places(PDO $pdo, int $id_trajet): bool {
    $stmt = $pdo->prepare("UPDATE trajet SET nbr_place = nbr_place - 1 WHERE id = ? AND nbr_place > 0");
    return $stmt->execute([$id_trajet]);
}
require_once(__DIR__ . '/../views/trajet_view.php');

