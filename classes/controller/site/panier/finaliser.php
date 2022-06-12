<?php
session_start();

require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/ViewPanier.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "panier.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Finalisation de la commande");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php"); // Message d'erreur
}

// Si le panier existe...
if (isset($_SESSION['panier'])) {
  verrouPanier(); // Verrouillage du panier
}

// Si le formulaire a été envoyé...
if (isset($_POST['mode'])) {
  envoi($_POST['mode'], $_POST['transporteur']); // Stocker les données
  header('Location: paiement.php'); // Redirection vers la page de paiement
}

// Si le client est connecté et si le panier est verrouillé...
if (isset($_SESSION['id']) && estVerrouille()) {
  ViewPanier::finalisation(); // Afficher le formulaire du choix du mode et du lieu de livraison
}

ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html