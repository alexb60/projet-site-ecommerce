<?php
session_start();
require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier mes informations employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  ViewTemplate::menu();

  $modelEmploye = new ModelEmploye();
  if (isset($_SESSION['id_employe']) && !isset($_POST['id'])) {
    if ($modelEmploye->voirEmploye($_SESSION['id_employe'])) {
      ViewEmploye::modifEmploye($_SESSION['id_employe']);
    } else {
      ViewTemplate::alert("danger", "Le profil employé n'existe pas", "accueil.php");
    }
  } else {
    if (isset($_POST['id']) && $modelEmploye->voirEmploye($_POST['id'])) {
      if ($modelEmploye->modifEmploye($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'])) {
        ViewTemplate::alert("success", "Le profil employé a été modifié avec succès", "accueil.php");
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
  <script src="../../../../js/validation-form-admin.js"></script>
</body>

</html>