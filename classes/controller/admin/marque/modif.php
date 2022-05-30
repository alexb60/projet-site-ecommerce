<?php
session_start();
require_once "../../../view/admin/ViewMarque.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelMarque.php";
?>

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
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();

    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Catégories'] == "oui") {
      $modelMarque = new ModelMarque();
      if (isset($_GET['id'])) {
        if ($modelMarque->voirMarque($_GET['id'])) {
          ViewMarque::modifMarque($_GET['id']);
        } else {
          ViewTemplate::alert("danger", "La marque n'existe pas", "liste.php");
        }
      } else {
        if (isset($_POST['id']) && $modelMarque->voirMarque($_POST['id'])) {

          $donnees = [$_POST['nom']];
          $types = ["nom"];
          $data = Utils::valider($donnees, $types);

          if ($data) {
            $extensions = ["jpg", "jpeg", "png", "gif"];
            $upload = Utils::upload($extensions, "marque", $_FILES['logo']);

            if ($_FILES['logo']['size'] === 0) { // SI PAS DE FICHIER ENVOYÉ
              $fichier = $modelMarque->voirMarque($_POST['id'])['logo']; // RÉCUPÉRATION DU NOM DU FICHIER DÉJÀ PRÉSENT EN BASE
              if ($modelMarque->modifMarque($_POST['id'], $_POST['nom'], $fichier)) {
                ViewTemplate::alert("success", "La marque a été modifiée avec succès", "liste.php");
              } else {
                ViewTemplate::alert("danger", "Erreur de modification sans fichier", "liste.php");
              }
            } elseif ($upload['uploadOk']) { // SINON SI FICHIER ENVOYÉ
              if ($modelMarque->modifMarque($_POST['id'], $_POST['nom'], $upload['file_name'])) {
                ViewTemplate::alert("success", "La marque a été modifiée avec succès", "liste.php");
              } else {
                ViewTemplate::alert("danger", "Erreur de modification", "liste.php");
              }
            } else {
              ViewTemplate::alert("danger", $upload['errors'], "liste.php");
            }
          } else {
            ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php");
          }
        } else {
          ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php");
        }
      }
    } else {
      ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
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
  <script src="../../../../js/validation-form-admin.js"></script>
</body>

</html>