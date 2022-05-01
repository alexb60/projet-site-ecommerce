<?php
session_start();
require_once "../../../view/admin/ViewClient.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelClient.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des clients</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();

    // PAGINATION
    if (isset($_GET['page']) && !empty($_GET['page'])) {
      $currentPage = (int) strip_tags($_GET['page']);
    } else {
      $currentPage = 1;
    }

    $modelClient = new ModelClient();
    $nbClients = (int) $modelClient->compteClient()['nb_clients']; // STOCKAGE DU NOMBRE DE CLIENTS PASSÉ EN INT DANS $nbClients
    $parPage = 10; // NOMBRE DE COMMANDES PAR PAGE VOULU

    $pages = ceil($nbClients / $parPage); // CALCUL DU NOMBRE DE PAGE NÉCESSAIRE ARRONDI À L'ENTIER SUPÉRIEUR
    $premier = ($currentPage * $parPage) - $parPage; // CALCUL DE LA 1ERE COMMANDE DE LA PAGE

  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Liste des clients</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
          ViewClient::listeClient($premier, $parPage);
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