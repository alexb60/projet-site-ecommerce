<?php
session_start();
require_once "../../../view/admin/ViewTransporteur.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelTransporteur.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'un transporteur</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();
    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Transporteurs'] == "oui") {
      $modelTransporteur = new ModelTransporteur();
      if (isset($_GET['id'])) {
        if ($modelTransporteur->voirTransporteur($_GET['id'])) {
          ViewTransporteur::modifTransporteur($_GET['id']);
        } else {
          ViewTemplate::alert("danger", "Le transporteur n'existe pas", "liste.php");
        }
      } else {
        $donnees = [$_POST['nom']];
        $types = ["nom"];
        $data = Utils::valider($donnees, $types);

        if ($data) {
          if (isset($_POST['id']) && $modelTransporteur->voirTransporteur($_POST['id'])) {
            $extensions = ["jpg", "jpeg", "png", "gif"];
            $upload = Utils::upload($extensions, "transporteur", $_FILES['logo']);

            if ($_FILES['logo']['size'] === 0) { // SI PAS DE FICHIER ENVOYÉ
              $fichier = $modelTransporteur->voirTransporteur($_POST['id'])['logo']; // RÉCUPÉRATION DU NOM DU FICHIER DÉJÀ PRÉSENT EN BASE
              if ($modelTransporteur->modifTransporteur($_POST['id'], $_POST['nom'], $fichier)) {
                ViewTemplate::alert("success", "Le transporteur a été modifié avec succès", "liste.php");
              } else {
                ViewTemplate::alert("danger", "Erreur de modification", "liste.php");
              }
            } elseif ($upload['uploadOk']) { // SINON SI FICHIER ENVOYÉ
              if ($modelTransporteur->modifTransporteur($_POST['id'], $_POST['nom'], $upload['file_name'])) {
                ViewTemplate::alert("success", "Le transporteur a été modifié avec succès", "liste.php");
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