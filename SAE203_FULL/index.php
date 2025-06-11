<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
session_start();

$route = $_GET['route'] ?? null;

switch ($route) {
    case null:
    case 'login':
        require('views/login_view.php');
        login_view();
        break;

    case 'auth': // pour traitement du formulaire login
        require('controllers/auth_ctrl.php');
        login_ctrl();
        break;

    case 'formulaire':
        require('views/formulaire.php');
        formulaire_view();
        break;

    case 'submit_form':
        require('controllers/form_ctrl.php');
        form_submit_ctrl();
        break;
    case 'trajets':
            require('controllers/trajet_controle.php');
            break;

    default:
        require('views/404_view.php');
        break;
}

