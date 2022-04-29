<?php
session_start();
require_once "../../../view/site/ViewCommande.php";
require_once "../../../view/site/ViewTemplate.php";

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-4">Liste des commandes passées</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        ViewCommande::listeCommandeClient($_SESSION['id']);
        ?>
      </div>
    </div>
  </div>
<?php
} else {
  ViewTemplate::headerInvite();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des commandes passées</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>