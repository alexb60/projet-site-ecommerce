<?php
session_start();

require_once "../../../view/site/ViewCommande.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Retour de commande");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté

  // Si le formulaire de retour est envoyé...
  if (isset($_POST['id_com'])) {
    $modelCommande = new ModelCommande();

    // Si le retour de commande se fait...
    if ($modelCommande->retourCommande($_POST['id_com'], $_POST['etat'], $_POST['motifRetour'])) {
      ViewTemplate::alert("success", "Demande de retour accepté", "listeCommandeClient.php?page=1"); // Afficher le succès
    } else {
      ViewTemplate::alert("danger", "Erreur", "listeCommandeClient.php?page=1"); // Message d'erreur
    }
  } else if (isset($_POST['id'])) { // Sinon si
    ViewCommande::retour();
  } else {
    ViewTemplate::alert("danger", "Une erreur s'est produite", "listeCommandeClient.php?page=1");
  }
} else {
  ViewTemplate::headerInvite();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html