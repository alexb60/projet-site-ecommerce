<?php
session_start();
require_once "../../../view/admin/ViewCommande.php";
require_once "../../../view/admin/ViewTemplate.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des commandes</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php

  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();
    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Commandes'] == "oui") {
      // PAGINATION
      if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
      } else {
        $currentPage = 1;
      }

      $modelCommande = new ModelCommande();
      $nbCommandes = (int) $modelCommande->compteCommande()['nb_commandes']; // STOCKAGE DU NOMBRE DE COMMANDES PASSÉ EN INT DANS $nbCommandes
      $parPage = 10; // NOMBRE DE COMMANDES PAR PAGE VOULU

      $pages = ceil($nbCommandes / $parPage); // CALCUL DU NOMBRE DE PAGE NÉCESSAIRE ARRONDI À L'ENTIER SUPÉRIEUR
      $premier = ($currentPage * $parPage) - $parPage; // CALCUL DE LA 1ERE COMMANDE DE LA PAGE

  ?>

      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-4">Liste des commandes</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php
            ViewCommande::listeCommande($premier, $parPage);
            ?>
            <nav>
              <ul class="pagination justify-content-center">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                  <a href="listeCommande.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
                </li>
                <?php for ($page = 1; $page <= $pages; $page++) : ?>
                  <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                  <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="listeCommande.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                  </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                  <a href="listeCommande.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
  <?php
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
</body>

</html>