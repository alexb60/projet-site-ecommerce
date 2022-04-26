<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout d'un transporteur</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewTransporteur.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../view/admin/utils.php";
  require_once "../../../model/ModelTransporteur.php";

  ViewTemplate::menu();
  if (isset($_POST['ajout'])) {
    $donnees = [$_POST['nom']];
    $types = ["nom"];
    $data = Utils::valider($donnees, $types);

    if ($data) {
      $extensions = ["jpg", "jpeg", "png", "gif"];
      $upload = Utils::upload($extensions, "transporteur", $_FILES['logo']);
      $modelTransporteur = new ModelTransporteur();

      if ($upload['uploadOk']) {
        if ($modelTransporteur->ajoutTransporteur($_POST['nom'], $upload['file_name'])) {
          ViewTemplate::alert("success", "Le transporteur a été ajouté avec succès", "liste.php");
        } else {
          ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php");
        }
      } else {
        ViewTemplate::alert("danger", $upload['errors'], "ajout.php");
      }
    } else {
      ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php");
    }
  } else {
    ViewTransporteur::ajoutTransporteur();
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>