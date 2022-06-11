<?php
session_start();

require_once "../../../view/admin/ViewMarque.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelMarque.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Listes des marques");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu();

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Marques'] == "oui") {
    $modelMarque = new ModelMarque();

    // Si l'id de la marque est passé en GET...
    if (isset($_GET['id'])) {

      // Si la marque existe dans la base de données...
      if ($modelMarque->voirMarque($_GET['id'])) {
        ViewMarque::modifMarque($_GET['id']); // Afficher le formulaire de modification de la marque
      } else {
        ViewTemplate::alert("danger", "La marque n'existe pas", "liste.php"); // Message d'erreur
      }
    } else {
      // Si le formulaire a été envoyé et si l'id envoyé existe dans la base de données...
      if (isset($_POST['id']) && $modelMarque->voirMarque($_POST['id'])) {
        $donnees = [$_POST['nom']]; // Tableau des données à vérifier...
        $types = ["nom"]; // Tableau des types de données à vérifier...
        $data = Utils::valider($donnees, $types); // Validation des données

        // Si les données sont conformes...
        if ($data) {
          $extensions = ["jpg", "jpeg", "png", "gif"]; // Tableau des extensions de fichiers autorisées
          $upload = Utils::upload($extensions, "marque", $_FILES['logo']); // Upload du logo de la marque

          // Si aucun fichier n'est envoyé...
          if ($_FILES['logo']['size'] === 0) {
            $fichier = $modelMarque->voirMarque($_POST['id'])['logo']; // Récupération du nom de fichier déjà présent en base

            // Si la modification se fait...
            if ($modelMarque->modifMarque($_POST['id'], $_POST['nom'], $fichier)) {
              ViewTemplate::alert("success", "La marque a été modifiée avec succès", "liste.php"); // Afficher le succès
            } else {
              ViewTemplate::alert("danger", "Erreur de modification sans fichier", "liste.php"); // Message d'erreur
            }
          } elseif ($upload['uploadOk']) { // Sinon si un fichier est uploadé...
            // Si la modification se fait...
            if ($modelMarque->modifMarque($_POST['id'], $_POST['nom'], $upload['file_name'])) {
              ViewTemplate::alert("success", "La marque a été modifiée avec succès", "liste.php"); // Afficher le succès
            } else {
              ViewTemplate::alert("danger", "Erreur de modification", "liste.php"); // Message d'erreur
            }
          } else {
            ViewTemplate::alert("danger", $upload['errors'], "liste.php"); // Sinon afficher les messages d'erreurs de l'upload
          }
        } else {
          ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php"); // Message d'erreur
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