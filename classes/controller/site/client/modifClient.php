<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/utils.php";
require_once "../../../model/ModelClient.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Modifier mes informations");

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté
  $modelClient = new ModelClient();

  // Si le formulaire n'est pas envoyé...
  if (!isset($_POST['id'])) {

    // Si le client existe dans la base de données...
    if ($modelClient->voirClient($_SESSION['id'])) {
      ViewClient::modifClient($_SESSION['id']); // Afficher le formulaire de modification client
    } else {
      ViewTemplate::alert("danger", "Le profil n'existe pas", "accueil.php"); // Message d'erreur
    }
  } else {

    // Si l'id est envoyé dans le formulaire et si l'id envoyé correspond à un client dans la base de données...
    if (isset($_POST['id']) && $modelClient->voirClient($_POST['id'])) {
      // Tableau des données à vérifier
      $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post']];
      $types = ["nom", "prenom", "email", "tel", "adresse", "ville", "code_post"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Vérification des données

      // Si les données sont conformes...
      if ($data) {
        $token = password_hash($_POST['mail'], PASSWORD_DEFAULT); // Hashage de l'adresse mail pour créer le token permettant la réinitialisation du mot de passe

        // Si la modification se fait...
        if ($modelClient->modifClient($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $token)) {
          $_SESSION['mail_client'] = $_POST['mail']; // Mise à jour de l'adresse mail dans la session
          ViewTemplate::alert("success", "Le profil a été modifié avec succès", "accueil.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Échec de la modification", "accueil.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Échec de la modification", "accueil.php"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "accueil.php"); // Message d'erreur
    }
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "index.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html