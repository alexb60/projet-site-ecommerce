<?php
session_start();

require_once "../../../view/admin/ViewProduit.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelProduit.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Modifier un produit");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu();

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Produits'] == "oui") {
    $modelProduit = new ModelProduit();

    // Si l'id du produit est passé en GET...
    if (isset($_GET['id'])) {

      // Si le produit existe dans la base de données...
      if ($modelProduit->voirProduit($_GET['id'])) {
        ViewProduit::modifProduit($_GET['id']); // Afficher le formulaire de modification du produit
      } else {
        ViewTemplate::alert("danger", "Le produit n'existe pas", "liste.php");
      }
    } else {
      $donnees = [$_POST['produit'], $_POST['ref'], $_POST['quantite'], $_POST['prix']]; // Tableau des données à vérifier
      $types = ["produit", "ref", "quantite", "prix"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Validation des données

      // Si les données sont conformes...
      if ($data) {

        // Si le formulaire est envoyé et si l'id envoyé dans le formulaire existe dans la base de données...
        if (isset($_POST['id']) && $modelProduit->voirProduit($_POST['id'])) {
          $extensions = ["jpg", "jpeg", "png", "gif"]; // Tableau des extensions de fichiers autorisés
          $upload = Utils::upload($extensions, "produit", $_FILES['photo']); // Upload de la photo

          // Si aucun fichier n'est envoyé...
          if ($_FILES['photo']['size'] === 0) {
            $fichier = $modelProduit->voirProduit($_POST['id'])['photo']; // Récupération du nom du fichier déjà présent en base

            // Si la modification se fait...
            if ($modelProduit->modifProduit($_POST['id'], $_POST['produit'], $_POST['ref'], $_POST['description'], $_POST['quantite'], $_POST['prix'], $fichier, $_POST['categorie'], $_POST['marque'])) {
              ViewTemplate::alert("success", "Le produit a été modifié avec succès", "liste.php"); // Afficher le succès
            } else {
              ViewTemplate::alert("danger", "Erreur de modification", "liste.php"); // Message d'erreur
            }
          } elseif ($upload['uploadOk']) { // Sinon si un fichier est uploadé...
            if ($modelProduit->modifProduit($_POST['id'], $_POST['produit'], $_POST['ref'], $_POST['description'], $_POST['quantite'], $_POST['prix'], $upload['file_name'], $_POST['categorie'], $_POST['marque'])) {
              ViewTemplate::alert("success", "Le produit a été modifié avec succès", "liste.php"); // Afficher le succès
            } else {
              ViewTemplate::alert("danger", "Erreur de modification", "liste.php"); // Message d'erreur
            }
          } else {
            ViewTemplate::alert("danger", $upload['errors'], "liste.php"); // Afficher les messages d'erreurs de l'upload
          }
        } else {
          ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php");  // Message d'erreur
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