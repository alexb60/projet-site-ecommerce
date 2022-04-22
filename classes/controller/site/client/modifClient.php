<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/site/ViewClient.php";
  require_once "../../../view/site/ViewTemplate.php";
  require_once "../../../model/ModelClient.php";

  $client = new ModelClient();
  if (isset($_GET['id'])) {
    if ($client->voirClient($_GET['id'])) {
      ViewClient::modifClient($_GET['id']);
    } else {
      ViewTemplate::alert("danger", "Le profil n'existe pas", "accueil.php");
    }
  } else {
    if (isset($_POST['id']) && $client->voirClient($_POST['id'])) {
      if ($client->modifClient($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post'])) {
        ViewTemplate::alert("success", "Le profil a été modifié avec succès", "accueil.php");
      } else {
        ViewTemplate::alert("danger", "Échec de la modification", "accueil.php");
      }
    } else {
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "accueil.php");
    }
  }
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>