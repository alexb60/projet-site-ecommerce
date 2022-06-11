<?php
session_start();

require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelProduit.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Ajout d'un produit");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Produits'] == "oui") {

    // Si le formulaire est envoyé...
    if (isset($_POST['produit'])) {
      $donnees = [$_POST['produit'], $_POST['ref'], $_POST['quantite'], $_POST['prix']]; // Tableau des données à vérifier
      $types = ["produit", "ref", "quantite", "prix"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Validation des données

      // Si les données sont conformes...
      if ($data) {
        $extensions = ["jpg", "jpeg", "png", "gif"]; // Tableau des extensions de fichiers autorisées
        $upload = Utils::upload($extensions, "produit", $_FILES['photo']); // Upload de la photo du produit
        $modelProduit = new ModelProduit();

        // Si la photo du produit est uploadé...
        if ($upload['uploadOk']) {

          // Si l'ajout du produit se fait...
          if ($modelProduit->ajoutProduit($_POST['produit'], $_POST['ref'], $_POST['description'], $_POST['quantite'], $_POST['prix'], $upload['file_name'], $_POST['categorie'], $_POST['marque'])) {
            ViewTemplate::alert("success", "Le produit a été ajouté avec succès", "liste.php"); // Afficher le succès
          } else {
            ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php"); // Message d'erreur
          }
        } else {
          ViewTemplate::alert("danger", $upload['errors'], "ajout.php"); // Afficher les messages d'erreurs de l'upload
        }
      } else {
        ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php"); // Message d'erreur
      }
    } else {
      ViewProduit::ajoutProduit(); // Afficher le formulaire d'ajout de produit
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