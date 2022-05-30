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
  <title>Ajout d'un produit</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();
    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Produits'] == "oui") {
      if (isset($_POST['produit'])) {
        $donnees = [$_POST['produit'], $_POST['ref'], $_POST['quantite'], $_POST['prix']];
        $types = ["produit", "ref", "quantite", "prix"];
        $data = Utils::valider($donnees, $types);

        if ($data) {
          $extensions = ["jpg", "jpeg", "png", "gif"];
          $upload = Utils::upload($extensions, "produit", $_FILES['photo']);
          $modelProduit = new ModelProduit();

          if ($upload['uploadOk']) {
            if ($modelProduit->ajoutProduit($_POST['produit'], $_POST['ref'], $_POST['description'], $_POST['quantite'], $_POST['prix'], $upload['file_name'], $_POST['categorie'], $_POST['marque'])) {
              ViewTemplate::alert("success", "Le produit a été ajouté avec succès", "liste.php");
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
        ViewProduit::ajoutProduit();
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