<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suppression d'un transporteur</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewTransporteur.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../model/ModelTransporteur.php";

  ViewTemplate::menu();

  if (isset($_GET['id'])) {
    $modelTransporteur = new ModelTransporteur();
    if ($modelTransporteur->voirTransporteur($_GET['id'])) {
      if ($modelTransporteur->suppTransporteur($_GET['id'])) {
        ViewTemplate::alert("success", "Transporteur supprimé avec succès", "liste.php");
      } else {
        ViewTemplate::alert("danger", "Échec de la suppression", "liste.php");
      }
    } else {
      ViewTemplate::alert("danger", "Le transporteur n'existe pas", "liste.php");
    }
  } else {
    ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php");
  }

  ViewTemplate::footer();

  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>