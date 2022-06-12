<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";
require_once "../panier/panier.php";

// Si le panier existe...
if (isset($_SESSION['panier'])) {
  supprimerProduit($_GET['id']); // Supprimer le produit donné
  header('Location: voirPanier.php'); // Redirection vers le panier
}
