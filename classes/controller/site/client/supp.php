<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Suppression du compte client");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  $client = new ModelClient();

  // Si la suppression se fait...
  if ($client->suppClient($_SESSION['id'])) {
    session_destroy(); // Destruction de la session
    ViewTemplate::headerInvite(); // Header invité
    ViewTemplate::alert("success", "Compte supprimé avec succès", "inscription.php"); // Afficher le succès
  } else {
    ViewTemplate::headerConnecte(); // Header client connecté
    ViewTemplate::alert("danger", "Échec de la suppression", "accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous ne pouvez pas accéder à cette page", "../index.php");
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html