<?php
require_once('/var/www/html/dev/SAE_R203-main/SAE203_FULL/models/ldap_model.php');
require_once('/var/www/html/dev/SAE_R203-main/SAE203_FULL/config/conf.php');

function login_ctrl() {
    $login = $_POST['login'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $uid = $prenom = $nom = '';
    global $pdo;

    if (auth_ldap($login, $pass, $uid, $prenom, $nom)) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }        
        $_SESSION['login'] = $login;
        $_SESSION['uid'] = $uid;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE id = ?");
        $stmt->execute([$uid]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            header("Location: index.php?route=trajets");
        } else {
            header("Location: index.php?route=formulaire");
        }
        exit;
    } else {
        echo "<p>Login ou mot de passe incorrect.</p>";
    }
}



