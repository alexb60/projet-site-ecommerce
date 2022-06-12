<?php
session_start();
require_once "../../../view/site/ViewCommande.php";
require_once "../../../view/site/ViewTemplate.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Liste des commandes passées");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
  ViewCommande::listeCommandeClient($_SESSION['id']); // Afficher la liste des commandes passées par le client
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html