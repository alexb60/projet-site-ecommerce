<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des produits</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php


  // PAGINATION
  if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
  } else {
    $currentPage = 1;
  }

  $modelProduit = new ModelProduit();
  $nbProduits = (int) $modelProduit->compteProduit()['nb_produits']; // STOCKAGE DU NOMBRE DE PRODUITS PASSÉ EN INT DANS $nbProduits
  $parPage = 15; // NOMBRE D'ARTICLES PAR PAGE VOULU

  $pages = ceil($nbProduits / $parPage); // CALCUL DU NOMBRE DE PAGE NÉCESSAIRE ARRONDI À L'ENTIER SUPÉRIEUR
  $premier = ($currentPage * $parPage) - $parPage; // CALCUL DU 1ER ARTICLE DE LA PAGE

  ?>
  <div class="container">

    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-4">Liste des produits</h2>
      </div>
      <div class="col-md-6 d-flex justify-content-end align-items-start">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        ViewProduit::listeProduit($premier, $parPage);
        ?>
        <nav>
          <ul class="pagination justify-content-center">
            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
              <a href="liste.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
            </li>
            <?php for ($page = 1; $page <= $pages; $page++) : ?>
              <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
              <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="liste.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
              </li>
            <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
              <a href="liste.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>