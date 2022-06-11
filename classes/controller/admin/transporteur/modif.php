<?php
session_start();

require_once "../../../view/admin/ViewTransporteur.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelTransporteur.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Modification d'un transporteur");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Transporteurs'] == "oui") {
    $modelTransporteur = new ModelTransporteur();

    // Si l'id du transporteur est passé en GET
    if (isset($_GET['id'])) {

      // Si le transporteur existe dans la base de données...
      if ($modelTransporteur->voirTransporteur($_GET['id'])) {
        ViewTransporteur::modifTransporteur($_GET['id']); // Afficher le formulaire de modification du transporteur
      } else {
        ViewTemplate::alert("danger", "Le transporteur n'existe pas", "liste.php"); // Message d'erreur
      }
    } else {
      $donnees = [$_POST['nom']]; // Tableau des données à vérifier
      $types = ["nom"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Validation des données

      // Si les données sont conformes...
      if ($data) {

        // Si l'id est envoyé dans le formulaire et si l'id du transporteur envoyé existe dans la base de données...
        if (isset($_POST['id']) && $modelTransporteur->voirTransporteur($_POST['id'])) {
          $extensions = ["jpg", "jpeg", "png", "gif"]; // Tableau des extensions de fichiers autorisées
          $upload = Utils::upload($extensions, "transporteur", $_FILES['logo']); // Upload du logo

          // Si aucun fichier n'est envoyé...
          if ($_FILES['logo']['size'] === 0) {
            $fichier = $modelTransporteur->voirTransporteur($_POST['id'])['logo']; // Récupération du nom du fichier déjà présent en base

            // Si la modification du transporteur se fait...
            if ($modelTransporteur->modifTransporteur($_POST['id'], $_POST['nom'], $fichier)) {
              ViewTemplate::alert("success", "Le transporteur a été modifié avec succès", "liste.php"); // Afficher le succès
            } else {
              ViewTemplate::alert("danger", "Erreur de modification", "liste.php"); // Message d'erreur
            }
          } elseif ($upload['uploadOk']) { // Sinon si un fichier est uploadé...

            // Si la modification du transporteur se fait...
            if ($modelTransporteur->modifTransporteur($_POST['id'], $_POST['nom'], $upload['file_name'])) {
              ViewTemplate::alert("success", "Le transporteur a été modifié avec succès", "liste.php"); // Afficher le succès
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