<?php
session_start();

require_once "../../../view/admin/ViewCategorie.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelCategorie.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suppression d'une catégorie</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();

    if (isset($_GET['id'])) {
      $modelCategorie = new ModelCategorie();
      if ($modelCategorie->voirCategorie($_GET['id'])) {
        if ($modelCategorie->suppCategorie($_GET['id'])) {
          ViewTemplate::alert("success", "Catégorie supprimée avec succès", "liste.php");
        } else {
          ViewTemplate::alert("danger", "Échec de la suppression", "liste.php");
        }
      } else {
        ViewTemplate::alert("danger", "La catégorie n'existe pas", "liste.php");
      }
    } else {
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php");
    }
  } else {
    ViewTemplate::headerInvite();
    ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php");
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>