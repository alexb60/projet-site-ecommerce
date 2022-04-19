<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout d'une catégorie</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewCategorie.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../model/ModelCategorie.php";

  ViewTemplate::menu();

  if (isset($_POST['ajout'])) {
    $categorie = new ModelCategorie();
    if ($categorie->ajoutCategorie($_POST['nom'])) {
      ViewTemplate::alert("success", "Catégorie ajoutée avec succès", "liste.php");
    } else {
      ViewTemplate::alert("danger", "Erreur d'ajout", "ajout.php");
    }
  } else {
    ViewCategorie::ajoutCategorie();
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>