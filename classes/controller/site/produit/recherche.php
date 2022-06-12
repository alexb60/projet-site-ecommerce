<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";

// Si le champ de recherche est vide...
if ($_POST['recherche'] == "") {
  header('Location: ../produit/index.php'); // Redirection vers la page d'accueil
}

// head HTML et ouverture de body
ViewTemplate::headHtml("Résultats de recherche");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
} else {
  ViewTemplate::headerInvite(); // Header invité
}

ViewProduit::recherche($_POST['recherche']); // Résultats de recherche
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html