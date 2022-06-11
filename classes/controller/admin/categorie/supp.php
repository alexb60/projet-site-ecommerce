<?php
session_start();

require_once "../../../view/admin/ViewCategorie.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelCategorie.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Suppression d'une catégorie");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Catégories'] == "oui") {

    // Si l'id de la catégorie est passé en GET
    if (isset($_GET['id'])) {
      $modelCategorie = new ModelCategorie();

      // Si l'id renvoie vers une catégorie existante...
      if ($modelCategorie->voirCategorie($_GET['id'])) {

        // Si la suppression se fait
        if ($modelCategorie->suppCategorie($_GET['id'])) {
          ViewTemplate::alert("success", "Catégorie supprimée avec succès", "liste.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Échec de la suppression", "liste.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "La catégorie n'existe pas", "liste.php"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php"); // Message d'erreur
    }
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}

ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html