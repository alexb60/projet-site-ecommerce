<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Liste des produits");

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
}

// PAGINATION
// Si la page est passé en GET et que le paramètre n'est pas vide...
if (isset($_GET['page']) && !empty($_GET['page'])) {
  $pageActuelle = (int) strip_tags($_GET['page']); // La page actuelle est égale au paramètre page passé par GET transformé de string à int
} else {
  $pageActuelle = 1; // Sinon la page actuelle est la page 1
}

$modelProduit = new ModelProduit();
$nbProduits = (int) $modelProduit->compteProduit()['nb_produits']; // STOCKAGE DU NOMBRE DE PRODUITS PASSÉ EN INT DANS $nbProduits
$parPage = 15; // NOMBRE DE PRODUITS PAR PAGE VOULU

$pages = ceil($nbProduits / $parPage); // CALCUL DU NOMBRE DE PAGE NÉCESSAIRE ARRONDI À L'ENTIER SUPÉRIEUR (fonction ceil)
$premier = ($pageActuelle * $parPage) - $parPage; // CALCUL DU 1ER PRODUIT DE LA PAGE
?>
<div class="container">
  <?php
  ViewProduit::listeProduit($premier, $parPage);
  ?>
  <nav>
    <ul class="pagination justify-content-center">
      <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
      <li class="page-item <?= ($pageActuelle == 1) ? "disabled" : "" ?>">
        <a href="liste.php?page=<?= $pageActuelle - 1 ?>" class="page-link">Précédent</a>
      </li>
      <?php
      // Pour chaque page allant de 1 au nombre total de pages - 1 en incrémentant de 1
      for ($page = 1; $page <= $pages; $page++) {
      ?>
        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
        <li class="page-item <?= ($pageActuelle == $page) ? "active" : "" ?>">
          <a href="liste.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
        </li>
      <?php
      }
      ?>
      <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
      <li class="page-item <?= ($pageActuelle == $pages) ? "disabled" : "" ?>">
        <a href="liste.php?page=<?= $pageActuelle + 1 ?>" class="page-link">Suivant</a>
      </li>
    </ul>
  </nav>
</div>
<?php
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html