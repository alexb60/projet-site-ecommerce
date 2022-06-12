<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

// Si le client est déjà connecté...
if (isset($_SESSION['id'])) {
  header('Location: accueil.php'); // Redirection vers la page d'accueil de l'espace client
}

ViewTemplate::headerInvite(); // Header invité

// Si le formulaire de connexion est envoyé...
if (isset($_POST['connexion'])) {
  $user = new ModelClient();
  $userData = $user->connexionClient($_POST['login']); // Récupération des informations du client selon son adresse mail

  // Si le client existe dans la base de données et si le mot de passe est correct...
  if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
    $_SESSION['id'] = $userData['id']; // Stockage de l'id du client dans la session
    $_SESSION['mail_client'] = $userData['mail']; // Stockage de l'adresse mail du client dans la session
    header('Location: ../produit/index.php'); // Redirection vers la page d'accueil du site
  } else {
    ViewTemplate::alert("danger", "L'adresse mail et le mot de passe ne correspondent pas", "connexion-client.php"); // Message d'erreur
  }
} else {
  ViewClient::connexion(); // Afficher le formulaire de connexion à l'espace client
}

// head HTML et ouverture de body
ViewTemplate::headHtml("Connexion à l'espace client");

ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html