<?php
session_start();
if (isset($_SESSION['id'])) {
  session_destroy();
}
session_start();

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";

ViewTemplate::headerInvite();

if (isset($_POST['connexion'])) {
  $user = new ModelEmploye();
  $userData = $user->connexionEmploye($_POST['login']);
  if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
    $_SESSION['id_employe'] = $userData['id'];
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
    <title>Connexion à l'espace employé</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
    <link rel="stylesheet" href="../../../../css/admin.css">
  </head>

  <body>
    <div class="container">
      <h2 class="mb-4">Connexion à l'espace employé</h2>
      <?php
      ViewEmploye::connexion();
      ?>
    </div>
  <?php
  ViewTemplate::footer();
}
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  </body>

  </html>