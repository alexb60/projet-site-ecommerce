<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelCategorie.php";
require_once "../../../model/ModelProduit.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>

  <?php
  if (isset($_SESSION['id'])) {
    ViewTemplate::headerConnecte();
  } else {
    ViewTemplate::headerInvite();
  }
  ?>
  <div class="container">
    <?php
    ViewProduit::derniersProduit();
    ViewProduit::produitParCategorie();
    ?>
  </div>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>