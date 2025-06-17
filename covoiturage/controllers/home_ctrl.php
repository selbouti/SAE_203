<?php
function home_ctrl() {
 if (session_status() === PHP_SESSION_NONE) session_start();
 global $pdo;
 require(__DIR__ . '/../controllers/auth_ctrl.php');

 if (!isset($_SESSION['uid'])) {
 header("Location: index.php?route=login");
 exit;
 }

 $uid = $_SESSION['login'];
 $stmt = $pdo->prepare("SELECT role FROM etudiant WHERE id = ?");
 $stmt->execute([$uid]);
 $role = $stmt->fetchColumn();

 if ($role === 'Conducteur') {
 require(__DIR__ . '/../views/conducteur_view.php');
 } elseif ($role === 'utilisateur') {
 require(__DIR__ . '/../views/passager_view.php');
 } else {
 echo "Rôle non reconnu.";
 }
}
