<?php
session_start();
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/utils.php";
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
  if (isset($_SESSION['id']) && !isset($_POST['id'])) { // SI L'ID DE LA SESSION EXISTE ET SI AUCUN ID PASSÉ EN POST
    if ($modelClient->voirClient($_SESSION['id'])) {
      ViewClient::modifClient($_SESSION['id']);
    } else {
      ViewTemplate::alert("danger", "Le profil n'existe pas", "accueil.php");
    }
  } else {
    if (isset($_POST['id']) && $modelClient->voirClient($_POST['id'])) {
      $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post']];
      $types = ["nom", "prenom", "email", "tel", "adresse", "ville", "code_post"];
      $data = Utils::valider($donnees, $types);

      if ($data) {
        $token = password_hash($_POST['mail'], PASSWORD_DEFAULT);
        if ($modelClient->modifClient($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $token)) {
          ViewTemplate::alert("success", "Le profil a été modifié avec succès", "accueil.php");
        } else {
          ViewTemplate::alert("danger", "Échec de la modification", "accueil.php");
        }
      } else {
        ViewTemplate::alert("danger", "Échec de la modification", "accueil.php");
      }
    } else {
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