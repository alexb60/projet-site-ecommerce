<?php
session_start();
if (isset($_SESSION['id'])) {
  header('Location: accueil.php');
}

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

ViewTemplate::headerInvite();

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
    $_SESSION['mail_client'] = $userData['mail'];
    header('Location: ../produit/index.php');
  } else {
    ViewTemplate::alert("danger", "L'adresse mail et le mot de passe ne correspondent pas", "connexion-client.php");
  }
} else {
  ViewClient::connexion();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion à l'espace client</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body class="d-flex flex-column min-vh-100">

  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>