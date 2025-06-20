<?php
// controllers/message_ctrl.php
require_once(__DIR__ . '/../models/message_crud.php');
require_once(__DIR__ . '/../config/conf.php');
#require_once(__DIR__ . '/../controllers/auth_ctrl.php');



function add_message_ctrl() {
    require_once(__DIR__ . '/../controllers/auth_ctrl.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();}
    require_once(__DIR__ . '/../models/message_crud.php');
    require_once(__DIR__ . '/../config/conf.php');
    $pdo;
    $expediteur = $_SESSION['login'];
    $conducteur_id = NULL;
    $destinataire =NULL;
    
    
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    // message ApresReservation
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type_message']=='ApresReservation'){
        $conducteur_id= recuperer_id_conducteur($_POST['trajet_id']);
        $contenu = trim($_POST['contenu']);
        $type_message='ApresReservation';
        $trajet_id=$_POST['trajet_id'];
        // conducteur contacte le passager 
        if (is_conducteur($expediteur,$conducteur_id)){
            echo '1';
            $destinataire = recuperer_id_passager($_POST['reservation_id']);
        }
        // passager contacte le conductuer
        elseif(is_passager($expediteur,$_POST['trajet_id'])){
            echo '2';
            $destinataire = recuperer_id_conducteur($trajet_id);
        }
    }

    // message AvantReservation
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['type_message']=='AvantReservation') {
        $conducteur_id= recuperer_id_conducteur($_POST['trajet_id']);
        $trajet_id = (int) $_POST['trajet_id'];
        $destinataire = recuperer_id_conducteur($trajet_id);
        $contenu = trim($_POST['contenu']);
        $type_message='AvantReservation';
        echo'3';
    }
    echo $conducteur_id;
    
    if (!$trajet_id || !$destinataire || !$expediteur || !$contenu) {
        echo "<p>Paramètres manquants.</p>";
        return;
    }

    if (is_conducteur($expediteur,$conducteur_id) || is_passager($expediteur,$_POST['trajet_id'])|| ($_POST['type_message']=='AvantReservation'&& $destinataire==$conducteur_id)&& !is_passager($expediteur,$_POST['trajet_id'])) {
        add_message($trajet_id, $expediteur, $destinataire, $contenu, $type_message,$_POST['reservation_id']);
        header("Location: index.php?route=list_messages&trajet_id=$trajet_id");
        exit;
    } else {
        echo "<p>Accès refusé.</p>";
    }
}
$conducteur_id = NULL;
$destinataire =NULL;

function list_messages_ctrl() {
    require_once(__DIR__ . '/../models/message_crud.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();}
    $user_id = $_SESSION['login'] ?? null;
    #$trajet_id = $_GET['trajet_id'] ?? null;

    if (!$user_id ) {
        echo "<p>Paramètres manquants.</p>";
        return;
    }

    $messages = get_messages_for_user_and_trajet($user_id);
    require(__DIR__ . '/../views/message_view.php');
    messages_view($messages);
}
