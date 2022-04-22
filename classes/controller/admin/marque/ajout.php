<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout d'une marque</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewMarque.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../model/ModelMarque.php";
  require_once "Utils.php";

  ViewTemplate::menu();
  if (isset($_POST['ajout'])) {
    $extensions = ["jpg", "jpeg", "png", "gif"];
    $upload = Utils::upload($extensions, $_FILES['fichier']);
    $marque = new ModelMarque();
    var_dump($upload);
    if ($upload['uploadOk']) {
      $marque->ajoutMarque($_POST['name'], $upload['file_name']);
      ViewTemplate::alert("success", "Marque ajoutée avec succès", "liste.php");
    } else {
      echo "<h1>" . $upload['errors'] . "</h1>";
      ViewTemplate::alert("danger", "Erreur d'ajout", "ajout.php");
    }
  } else {
    ViewMarque::ajoutMarque();
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>