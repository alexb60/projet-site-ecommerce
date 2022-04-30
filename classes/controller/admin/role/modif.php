<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'un rôle</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewRole.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../model/ModelRole.php";

  ViewTemplate::menu();

  $modelRole = new ModelRole();
  if (isset($_GET['id'])) {
    if ($modelRole->voirRole($_GET['id'])) {
      ViewRole::modifRole($_GET['id']);
    } else {
      ViewTemplate::alert("danger", "Le rôle n'existe pas", "liste.php");
    }
  } else {
    if (isset($_POST['id']) && $modelRole->voirRole($_POST['id'])) {
      if ($modelRole->modifRole($_POST['id'], $_POST['nom'])) {
        ViewTemplate::alert("success", "Le rôle a été modifié avec succès", "liste.php");
      } else {
        ViewTemplate::alert("danger", "Échec de la modification", "liste.php");
      }
    } else {
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php");
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