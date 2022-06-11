<?php
session_start();

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Connexion à l'espace employé");

ViewTemplate::headerInvite(); // Navbar admin invité

// Si l'id de l'employé existe dans la session...
if (isset($_SESSION['id_employe'])) {
  header('Location: accueil.php'); // Redirection vers l'accueil de l'espace employé
}

// Si les données ont été envoyées en POST
if (isset($_POST['connexion'])) {
  $user = new ModelEmploye();
  $userData = $user->connexionEmploye($_POST['login']); // Stockage des informations de l'utilisateur dans la variable $userData

  // S'il y a des données dans $userData et si le mot de passe correspond à celui enregistré dans la base de données...
  if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
    $_SESSION['id_employe'] = $userData['id']; // Stockage de l'id de l'employé dans la variable $_SESSION
    $_SESSION['role'] = $userData['id_role']; // Stockage de l'id du rôle dans la variable $_SESSION
    // Décodage de l'objet JSON contenant les permissions en tableau associatif PHP et stockage dans la variable $_SESSION
    $_SESSION['perm'] = json_decode($userData['perm'], true);
    header('Location: accueil.php'); // Redirection vers l'accueil de l'espace employé
  } else {
    ViewTemplate::alert("danger", "L'adresse mail et le mot de passe ne correspondent pas", "connexion-employe.php"); // Message d'erreur
  }
} else {
  ViewEmploye::connexion(); // Affichage du formulaire de connexion
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html