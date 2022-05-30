<?php
session_start();

require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";

if ($_POST['recherche'] == "") {
  header('Location: ../produit/liste.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Résultats de recherche</title>
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

      $modelProduit = new ModelProduit();
  ?>
      <div class="container">
        <form action="../produit/recherche.php" method="post" class="form-inline d-flex justify-content-center mx-auto mb-4">
          <input class="form-control mr-sm-2 recherche" type="search" placeholder="Chercher un produit" name="recherche" aria-label="Search" id="recherche">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>&nbsp; Chercher</button>
        </form>
        <?php
        ViewProduit::recherche($_POST['recherche']);
        ?>
      </div>
  <?php
    } else {
      ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
    }
  } else {
    ViewTemplate::headerInvite();
  }
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>