<?php
session_start();

require_once "../../../view/admin/ViewRole.php";
require_once "../../../view/admin/ViewTemplate.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Détails d'un rôle");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Rôles'] == "oui") {
    ViewRole::voirRole($_GET['id']); // Afficher les détails du rôle
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html