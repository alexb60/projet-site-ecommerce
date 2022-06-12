<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";
require_once "../panier/panier.php";

// Si le panier existe...
if (isset($_SESSION['panier'])) {
  deverrouillagePanier(); // Fonction de déverrouillage du panier
  header('Location: voirPanier.php'); // Redirection vers la page du panier
}

