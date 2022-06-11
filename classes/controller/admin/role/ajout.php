<?php
session_start();

require_once "../../../view/admin/ViewRole.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelRole.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Ajout d'un rôle");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Rôles'] == "oui") {

    // Si le formulaire est envoyé
    if (isset($_POST['nom'])) {
      $donnees = [$_POST['nom']]; // Tableau des données à vérifier
      $types = ["nom"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Vérification des données

      // Création du tableau associatif des permissions
      $tabPerm = array("Produits" => $_POST['produit'], "Catégories" => $_POST['categorie'], "Marques" => $_POST['marque'], "Transporteurs" => $_POST['transporteur'], "Rôles" => $_POST['role'], "Employés" => $_POST['employe'], "Commandes" => $_POST['commande'], "Clients" => $_POST['client'], "Messages" => $_POST['message']);
      $perm = json_encode($tabPerm); // Encodage du tableau en objet JSON

      // Si les données sont conformes...
      if ($data) {
        $role = new ModelRole();

        // Si l'ajout se fait...
        if ($role->ajoutRole($_POST['nom'], $perm)) {
          ViewTemplate::alert("success", "Rôle ajouté avec succès", "liste.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Erreur d'ajout", "ajout.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php"); // Message d'erreur
      }
    } else {
      ViewRole::ajoutRole(); // Afficher le formule d'ajout de rôle
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