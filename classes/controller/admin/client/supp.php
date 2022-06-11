<?php
session_start();

require_once "../../../view/admin/ViewClient.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Suppression du compte d'un client");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {

  ViewTemplate::menu();
  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Clients'] == "oui") {
    // Si l'id est passé en GET...
    if (isset($_GET['id'])) {
      $client = new ModelClient();
      // Si la suppression se fait...
      if ($client->suppClient($_GET['id'])) {
        ViewTemplate::alert("success", "Compte supprimé avec succès", "liste.php?page=1"); // Afficher le succès
      } else {
        ViewTemplate::alert("danger", "Échec de la suppression", "liste.php?page=1"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Le profil n'existe pas", "liste.php?page=1"); // Message d'erreur
    }
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Navbar admin invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}

ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html