<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../model/ModelClient.php";

if (isset($_SESSION['id']) && $_SESSION['role'] === 'admin') {
  header('Location: admin.php');
  exit;
}

if (isset($_SESSION['id']) && $_SESSION['role'] === 'user') {
  header('Location: accueil.php');
  exit;
}

if (isset($_POST['connexion'])) {
  $user = new ModelClient();
  $userData = $user->connexionClient($_POST['login']);
  if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
    $_SESSION['id'] = $userData['id'];
    $_SESSION['nom'] = $userData['nom'];
    $_SESSION['prenom'] = $userData['prenom'];
    header('Location: accueil.php');
  } else {
    echo "Echec d'authentification";
  }
} else {

?>

  <!DOCTYPE html>
  <html lang="fr">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion espace client</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
    <link rel="stylesheet" href="../../../../css/admin.css">
  </head>

  <body>
  <?php
  ViewClient::connexion();
}


  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  </body>

  </html>