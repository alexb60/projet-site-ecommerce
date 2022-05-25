<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

ViewTemplate::headerInvite();

if (!isset($_POST['mail'])) {
  ViewClient::recupMail();
} else {
  $modelClient = new ModelClient();
  if ($modelClient->recupToken($_POST['mail'])) {
    $recup = $modelClient->recupToken($_POST['mail']);
    if (password_verify($_POST['mail'], $recup['token'])) {
      $_SESSION['mail'] = $_POST['mail'];
      header('Location: modifPass.php');
    }
    else {
      ViewTemplate::alert("danger", "Erreur lors de la récupération de l'adresse mail", "recupMail.php");
    }
  } else {
    ViewTemplate::alert("danger", "L'adresse mail n'existe pas", "recupMail.php");
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Récupération de l'adresse mail</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form.js"></script>
</body>

</html>