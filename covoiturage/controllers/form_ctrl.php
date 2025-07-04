 <?php
 require(__DIR__ . '/../config/conf.php');
 function form_submit_ctrl() {
    
    require(__DIR__ . '/../controllers/auth_ctrl.php');
    if (session_status() === PHP_SESSION_NONE) {
    session_start();}
    
    if (!isset($_SESSION['uid'])) {
    header("Location: index.php?route=login"); 
    exit;
    }
    
    global $pdo;
    $uid = $_SESSION['login'];
        
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM etudiant WHERE id = ?");
    $stmt->execute([$uid]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
    header("Location: index.php?route=home");
    exit;
 }
 

 $uid = $_SESSION['login'];
 $nom_complet = $_POST['nom'];
 $sujet = $_POST['sujet'];
 $adresse = $_POST['adresse'];
 $gps = $_POST['gps'];
 $email = $_POST['email'];
 $departement = $_POST['departement'];
 $niveau = $_POST['niveau'];

 $stmt = $pdo->prepare("INSERT INTO etudiant (id, nom, role, adresse, gps, departement, niveau) VALUES (?, ?, ?, ?, ?, ?, ?)");
 $stmt->execute([$uid, $nom_complet, $sujet, $adresse, $gps, $departement, $niveau]);

 header("Location: index.php?route=home");
 exit;
 }
