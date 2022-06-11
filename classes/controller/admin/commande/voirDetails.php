<?php
session_start();

require_once "../../../view/admin/ViewCommande.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Détails de la commande");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Commandes'] == "oui") {
    ViewCommande::voirDetails($_GET['id_com']); // Afficher les détails de la commande
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html