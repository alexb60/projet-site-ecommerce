<?php
session_start();

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelEmploye.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Modifier le profil d'un employé");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Employés'] == "oui") {
    $modelEmploye = new ModelEmploye();

    // Si l'id de l'employé n'est pas passé en POST
    if (!isset($_POST['id'])) {

      // Si la requête pour voir les infos d'un employé renvoie des données...
      if ($modelEmploye->voirEmploye($_GET['id'])) {
        ViewEmploye::modifEmploye($_GET['id']); // Afficher le formulaire de modification avec les données de l'employé
      } else {
        ViewTemplate::alert("danger", "Le profil employé n'existe pas", "accueil.php"); // Message d'erreur
      }
    } else {
      // Si l'id de l'employé est passé en POST et si la requête pour voir une catégorie renvoie des données...
      if (isset($_POST['id']) && $modelEmploye->voirEmploye($_POST['id'])) {
        $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail']]; // Tableau contenant les données à vérifier
        $types = ["nom", "prenom", "email"]; // Tableau des types de données à vérifier
        $data = Utils::valider($donnees, $types); // Vérification des données

        // Si les données sont conformes...
        if ($data) {
          $token = password_hash($_POST['mail'], PASSWORD_DEFAULT); // Création du token de récupération du mot de passe par hashage de l'adresse mail

          // Si la modification est effectuée..
          if ($modelEmploye->modifEmploye($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['role'], $token)) {
            ViewTemplate::alert("success", "Le profil employé a été modifié avec succès", "javascript:history.go(-2)"); // Afficher le succès
          } else {
            ViewTemplate::alert("danger", "Échec de la modification", "javascript:history.back()"); // Message d'erreur
          }
        } else {
          ViewTemplate::alert("danger", "Échec de la modification, les données ne sont pas conformes", "javascript:history.back()"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "javascript:history.back()"); // Message d'erreur
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