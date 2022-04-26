<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'une marque</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewMarque.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../view/admin/utils.php";
  require_once "../../../model/ModelMarque.php";

  ViewTemplate::menu();

  $modelMarque = new ModelMarque();
  if (isset($_GET['id'])) {
    if ($modelMarque->voirMarque($_GET['id'])) {
      ViewMarque::modifMarque($_GET['id']);
    } else {
      ViewTemplate::alert("danger", "La marque n'existe pas", "liste.php");
    }
  } else {
    if (isset($_POST['id']) && $modelMarque->voirMarque($_POST['id'])) {
      $extensions = ["jpg", "jpeg", "png", "gif"];
      $upload = Utils::upload($extensions, "marque", $_FILES['logo']);


      if ($upload['uploadOk']) { // SI FICHIER ENVOYÉ
        if ($modelMarque->modifMarque($_POST['id'], $_POST['nom'], $upload['file_name'])) {
          ViewTemplate::alert("success", "La marque a été modifiée avec succès", "liste.php");
        } else {
          ViewTemplate::alert("danger", "Erreur de modification", "liste.php");
        }
        // } elseif ($_FILES['logo'] === null) { // SINON SI PAS DE FICHIER ENVOYÉ
        //   if ($modelMarque->modifMarque($_POST['id'], $_POST['nom'], $modelMarque->voirMarque($_GET['id'])['logo'])) {
        //     ViewTemplate::alert("success", "La marque a été modifiée avec succès", "liste.php");
        //   } else {
        //     ViewTemplate::alert("danger", "Erreur de modification sans fichier", "liste.php");
        //   }
      } else {
        ViewTemplate::alert("danger", $upload['errors'], "liste.php");
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
</body>

</html>