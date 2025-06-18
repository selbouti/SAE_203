<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
session_start();

$route = $_GET['route'] ?? null;

switch ($route) {
 case null:
 case 'home':
        require 'controllers/home_ctrl.php';
        home_ctrl();
        break;
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
 case 'rides':
 require('controllers/ride_ctrl.php');
 require('views/proposer.php');
 handleRideSubmission();
 break;
 case 'reserver_trajet':
       require 'controllers/reservation_controle.php';
       ctrl_reserver_trajet();
       break;
   
   case 'mes_reservations':
       require 'controllers/reservation_controle.php';
       ctrl_mes_reservations();
       break;
   
   case 'reservation_success':
       require 'controllers/reservation_controle.php';
       ctrl_confirmation_succes();
       break;
 case 'mes_trajets':
       require 'controllers/reservation_controle.php';
       ctrl_mes_trajets();
       break;
          
case 'voir_reservations':
       require 'controllers/reservation_controle.php';
       ctrl_reservations_trajet();
       break;
          
case 'changer_statut':
       require 'controllers/reservation_controle.php';
       ctrl_changer_statut();
       break;
   
 case 'send_message':
    require('controllers/message_ctrl.php');
    add_message_ctrl();
    break;
case 'message':
    require('views/message_view.php');
    add_message_ctrl();
    break;

case 'list_messages':
    require('controllers/message_ctrl.php');
    list_messages_ctrl();
    break;
 
 default:
 require('views/404_view.php');
 break;
 
}

