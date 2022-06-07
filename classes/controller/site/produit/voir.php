<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";
require_once "../panier/panier.php";

if (isset($_POST['id'])) {
  ajoutPanier($_POST['id'], $_POST['quantite'], $_POST['prix']);
  header('Location: ../panier/voirPanier.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails d'un produit</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  if (isset($_SESSION['id'])) {
    ViewTemplate::headerConnecte();
  } else {
    ViewTemplate::headerInvite();
  }

  ViewProduit::voirProduit($_GET['id']);
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>