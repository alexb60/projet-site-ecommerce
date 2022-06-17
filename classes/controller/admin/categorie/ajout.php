<?php
session_start();

require_once "../../../view/admin/ViewCategorie.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelCategorie.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Ajout d'une catégorie");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Affichage du menu admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Catégories'] == "oui") {

    // Si le formulaire est envoyé...
    if (isset($_POST['nom'])) {
      $donnees = [$_POST['nom']]; // Tableau contenant les données à vérifier
      $types = ["nom"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Vérification des données

      // Si les données sont conformes...
      if ($data) {
        $categorie = new ModelCategorie();

        // Si l'ajout de la catégorie se fait...
        if ($categorie->ajoutCategorie($_POST['nom'])) {
          ViewTemplate::alert("success", "Catégorie ajoutée avec succès", "liste.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Erreur d'ajout", "ajout.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Erreur d'ajout, les données ne sont pas conformes", "liste.php"); // Message d'erreur
      }
    } else {
      ViewCategorie::ajoutCategorie(); // Afficher le formulaire d'ajout de catégorie
    }
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Navbar invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}

ViewTemplate::footer(); // Footer
ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html
