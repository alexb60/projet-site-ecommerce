<?php
session_start();
require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/ViewMarque.php";
require_once "../../../view/admin/ViewCategorie.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelProduit.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'un produit</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();

    $modelProduit = new ModelProduit();
    if (isset($_GET['id'])) {
      if ($modelProduit->voirProduit($_GET['id'])) {
        ViewProduit::modifProduit($_GET['id']);
      } else {
        ViewTemplate::alert("danger", "Le transporteur n'existe pas", "liste.php");
      }
    } else {
      $donnees = [$_POST['nom'], $_POST['ref'], $_POST['quantite'], $_POST['prix']];
      $types = ["nomProduit", "ref", "quantite", "prix"];
      $data = Utils::valider($donnees, $types);

      if ($data) {
        if (isset($_POST['id']) && $modelProduit->voirProduit($_POST['id'])) {
          $extensions = ["jpg", "jpeg", "png", "gif"];
          $upload = Utils::upload($extensions, "produit", $_FILES['photo']);

          if ($_FILES['photo']['size'] === 0) { // SI PAS DE FICHIER ENVOYÉ
            $fichier = $modelProduit->voirProduit($_POST['id'])['photo']; // RÉCUPÉRATION DU NOM DU FICHIER DÉJÀ PRÉSENT EN BASE
            if ($modelProduit->modifProduit($_POST['id'], $_POST['nom'], $_POST['ref'], $_POST['description'], $_POST['quantite'], $_POST['prix'], $fichier, $_POST['categorie'], $_POST['marque'])) {
              ViewTemplate::alert("success", "Le produit a été modifié avec succès", "liste.php");
            } else {
              ViewTemplate::alert("danger", "Erreur de modification", "liste.php");
            }
          } elseif ($upload['uploadOk']) { // SINON SI FICHIER ENVOYÉ
            if ($modelProduit->modifProduit($_POST['id'], $_POST['nom'], $_POST['ref'], $_POST['description'], $_POST['quantite'], $_POST['prix'], $upload['file_name'], $_POST['categorie'], $_POST['marque'])) {
              ViewTemplate::alert("success", "Le produit a été modifié avec succès", "liste.php");
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
    ViewTemplate::headerInvite();
  ?>
    <div class="container">
      <?php
      ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php");
      ?>
    </div>
  <?php
  }
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script src="../../../../js/validation-form.js"></script> -->
</body>

</html>