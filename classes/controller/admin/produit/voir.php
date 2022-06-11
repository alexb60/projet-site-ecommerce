<?php
session_start();

require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Détails d'un produit");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Produits'] == "oui") {
    ViewProduit::voirProduit($_GET['id']); // Afficher les détails du produit
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html