<?php
session_start();

require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";

// Si le champ de recherche est vide...
if ($_POST['recherche'] == "") {
  header('Location: ../produit/liste.php'); // Redirection vers la liste des produits
}

// head HTML et ouverture de body
ViewTemplate::headHtml("Résultats de recherche");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Produits'] == "oui") {
    ViewProduit::recherche($_POST['recherche']); // Afficher les résultats de la recherche
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html