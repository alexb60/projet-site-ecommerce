<?php
session_start();

require_once "../../../view/site/ViewCommande.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Retour de commande");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Heaer client connecté

  $modelCommande = new ModelCommande();
  $commande = $modelCommande->checkIdClient($_GET['id_com']); // Stockage de l'id du client associé à la commande dont l'id est passsé en GET

  // Si l'id du client de la commande correspond à l'id du client connecté...
  if ($commande['id_client'] == $_SESSION['id']) {
    ViewCommande::voirDetailsClient($_GET['id_com']); // Afficher les détails de la commande
  } else {
    ViewTemplate::alert("danger", "La commande n'existe pas", "javascript:history.back()"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html