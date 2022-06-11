<?php
session_start();

require_once "../../../view/admin/ViewMarque.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelMarque.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Détails d'une marque");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Marques'] == "oui") {
    ViewMarque::voirMarque($_GET['id']); // Afficher les détails de la marque
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html