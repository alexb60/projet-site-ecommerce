<?php
session_start();
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier mes informations</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php
  ViewTemplate::headerConnecte();

  $modelClient = new ModelClient();
  if (isset($_SESSION['id'])) {
    if ($modelClient->voirClient($_SESSION['id'])) {
      ViewClient::modifClient($_SESSION['id']);
      echo "var dump if isset";
      var_dump($_POST);
    } else {
      ViewTemplate::alert("danger", "Le profil n'existe pas", "accueil.php");
    }
  } else {
    echo "test else";
    var_dump($_POST);
    if (isset($_POST['id']) && $modelClient->voirClient($_POST['id'])) {
      echo "test modif";
      if ($modelClient->modifClient($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post'])) {
        echo "C'est gagné !";
        ViewTemplate::alert("success", "Le profil a été modifié avec succès", "accueil.php");
      } else {
        echo "Raté !";
        ViewTemplate::alert("danger", "Échec de la modification", "accueil.php");
      }
    } else {
      echo "Non !";
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "accueil.php");
    }
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script src="../../../../js/validation-form.js"></script> -->
</body>

</html>