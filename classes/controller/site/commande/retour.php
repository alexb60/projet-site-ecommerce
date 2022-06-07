<?php
session_start();
require_once "../../../view/site/ViewCommande.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Retour de commande</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  if (isset($_SESSION['id'])) {
    ViewTemplate::headerConnecte();
    if (isset($_POST['id_com'])) {
      $modelCommande = new ModelCommande();
      if ($modelCommande->retourCommande($_POST['id_com'], $_POST['etat'], $_POST['motifRetour'])) {
        ViewTemplate::alert("success", "Demande de retour accepté", "listeCommandeClient.php?page=1");
      } else {
        ViewTemplate::alert("danger", "Erreur", "listeCommandeClient.php?page=1");
      }
    } else if (isset($_POST['id'])) {
      ViewCommande::retour();
    } else {
      ViewTemplate::alert("danger", "Une erreur s'est produite", "listeCommandeClient.php?page=1");
    }
  } else {
    ViewTemplate::headerInvite();
    ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
  }
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form.js"></script>
  <script src="../../../../js/main.js"></script>
</body>

</html>