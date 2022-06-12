<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelCategorie.php";
require_once "../../../model/ModelProduit.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Accueil");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
} else {
  ViewTemplate::headerInvite(); // Header invité
}
?>
<div class="container">
  <?php
  ViewProduit::derniersProduit(); // Afficher les derniers produits ajoutés
  ViewProduit::produitParCategorie(); // Afficher les produits par catégories
  ?>
</div>
<?php
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html