<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../panier/panier.php";

// Si le formulaire d'ajout au panier est envoyé...
if (isset($_POST['id'])) {
  ajoutPanier($_POST['id'], $_POST['quantite'], $_POST['prix']); // Ajouter le produit au panier
  header('Location: ../panier/voirPanier.php'); // Redirection vers le panier
}

// head HTML et ouverture de body
ViewTemplate::headHtml("Détails d'un produit");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
} else {
  ViewTemplate::headerInvite(); // Header invité
}

ViewProduit::voirProduit($_GET['id']); // Afficher les détails du produit
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html