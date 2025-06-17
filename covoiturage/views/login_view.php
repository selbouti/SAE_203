<?php function login_view() { ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="/dev/SAE_203/covoiturage/css/stylelog.css">
</head>
<body>
  <div class="container" id="container">
    <div class="form-container sign-in-container">
      <form action="index.php?route=auth" method="POST">
        <img src="/dev/SAE_203/covoiturage/images/logo.png" class="logo-form" alt="Logo">
        <h1>Connexion</h1>
        <input type="text" name="login" placeholder="Login Universitaire" required>
        <input type="password" name="pass" placeholder="Mot de passe" required>
        <button type="submit">Connexion</button>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-right">
          <h1>Bonjour !</h1>
          <p>Un campus, une planète : covoiturons ensemble.</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php } ?>

