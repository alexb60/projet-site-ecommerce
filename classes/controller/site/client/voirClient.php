<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Mes informations");

// Si l'utilisateur est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
  ViewClient::voirClient($_SESSION['id']); // Affichage du profil du client
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Erreur, le profil n'existe pas", "accueil.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html