<?php
session_start();

require_once "../../../view/site/ViewMessage.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/utils.php";
require_once "../../../model/ModelMessage.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Contact");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté

  // Si le formulaire est envoyé...
  if (isset($_POST['motif'])) {
    $donnees = [$_POST['message']]; // Tableau des données à vérifier
    $types = ["description"]; // Tableau des types de données à vérifier
    $data = Utils::valider($donnees, $types); // Validation des données

    // Si les données sont conformes...
    if ($data) {
      $message = new ModelMessage();
      date_default_timezone_set('Europe/Paris'); // La date et l'heure seront basés sur celles de Paris en France

      // Si l'envoi du message se fait...
      if ($message->ajoutMessageClient($_POST['motif'], date("Y-m-d H:i:s"), $_POST['message'], $_SESSION['id'])) {
        ViewTemplate::alert("success", "Message envoyé avec succès", "../client/accueil.php"); // Afficher le succès
      } else {
        ViewTemplate::alert("danger", "Erreur d'envoi", "contact.php"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Un problème est survenu, veuillez réessayer", "javascript:history.back()"); // Message d'erreur
    }
  } else {
    ViewMessage::ajoutMessageClient(); // Afficher le formualaire de contact
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php"); // Message d'erreur
}

ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html