<?php
session_start();

require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Suppression d'un produit");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Produits'] == "oui") {

    // Si l'id du produit est passé en GET
    if (isset($_GET['id'])) {
      $modelProduit = new ModelProduit();

      // Si le produit existe dans la base de données...
      if ($modelProduit->voirProduit($_GET['id'])) {

        // Si la suppression du produit se fait...
        if ($modelProduit->suppProduit($_GET['id'])) {
          ViewTemplate::alert("success", "Produit supprimé avec succès", "liste.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Échec de la suppression", "liste.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Le produit n'existe pas", "liste.php"); // Message d'erreur
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