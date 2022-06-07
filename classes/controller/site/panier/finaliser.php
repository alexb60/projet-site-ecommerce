<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/ViewPanier.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "panier.php";

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
  session_destroy();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}

if (isset($_SESSION['panier'])) {
  verrouPanier();
}

if (isset($_POST['mode'])) {
  envoi($_POST['mode'], $_POST['transporteur']);
  header('Location: paiement.php');
}

if (isset($_SESSION['id']) && estVerrouille()) {
  ViewPanier::finalisation();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalisation de la commande</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form.js"></script>
</body>