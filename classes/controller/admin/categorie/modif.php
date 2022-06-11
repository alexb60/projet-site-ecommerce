<?php
session_start();

require_once "../../../view/admin/ViewCategorie.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelCategorie.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Modification d'une catégorie");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Affichage du menu

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Catégories'] == "oui") {
    $modelCategorie = new ModelCategorie();

    // Si l'id de la catégorie est passé en GET
    if (isset($_GET['id'])) {

      // Si la requête pour voir une catégorie renvoie des données...
      if ($modelCategorie->voirCategorie($_GET['id'])) {
        ViewCategorie::modifCategorie($_GET['id']); // Afficher le formulaire avec les données de la catégorie à modifier
      } else {
        ViewTemplate::alert("danger", "La catégorie n'existe pas", "liste.php"); // Message d'erreur
      }
    } else {
      // Si l'id de la catéogire est passé en POST et si la requête pour voir une catégorie renvoie des données...
      if (isset($_POST['id']) && $modelCategorie->voirCategorie($_POST['id'])) {
        $donnees = [$_POST['nom']]; // Tableau contenant les données à vérifier
        $types = ["nom"]; // Tableau des types de données à vérifier
        $data = Utils::valider($donnees, $types); // Vérification des données

        // Si les données sont conformes...
        if ($data) {
          // Si la modification de la catégorie se fait...
          if ($modelCategorie->modifCategorie($_POST['id'], $_POST['nom'])) {
            ViewTemplate::alert("success", "La catégorie a été modifiée avec succès", "liste.php"); // Afficher le succès
          } else {
            ViewTemplate::alert("danger", "Échec de la modification", "liste.php"); // Message d'erreur
          }
        } else {
          ViewTemplate::alert("danger", "Échec de la modification, les données ne sont pas conformes", "liste.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php"); // Message d'erreur
      }
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
