<?php
session_start();

require_once "../../../view/admin/ViewCommande.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Changement d'état d'une commande");

if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Commandes'] == "oui") {
    $modelCommande = new ModelCommande();

    // Si l'id de la comande est passé en GET...
    if (isset($_GET['id'])) {

      // Si la commande existe dans la base de données...
      if ($modelCommande->voirCommande($_GET['id'])) {
        ViewCommande::modifEtat($_GET['id']); // Afficher le formulaire de modification d'état
      } else {
        ViewTemplate::alert("danger", "La commande n'existe pas", "listeCommande.php"); // Message d'erreur
      }
    } else {
      // Si le formulaire est envoyé et si l'id envoyé correspond à une commande dans la base de données...
      if (isset($_POST['id']) && $modelCommande->voirCommande($_POST['id'])) {

        // Si la modification se fait...
        if ($modelCommande->modifEtat($_POST['id'], $_POST['etat'])) {
          ViewTemplate::alert("success", "L'état de la commande a été modifié avec succès", "listeCommande.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Échec de la modification", "listeCommande.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "listeCommande.php"); // Message d'erreur
      }
    }
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}

ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html