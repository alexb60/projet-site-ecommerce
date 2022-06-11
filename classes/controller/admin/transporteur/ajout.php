<?php
session_start();

require_once "../../../view/admin/ViewTransporteur.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelTransporteur.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Ajout d'un transporteur");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Transporteurs'] == "oui") {

    // Si le formulaire est envoyé...
    if (isset($_POST['nom'])) {
      $donnees = [$_POST['nom']]; // Tableau des données à vérifier
      $types = ["nom"]; // Tableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Vérification des données

      // Si les données sont conformes...
      if ($data) {
        $extensions = ["jpg", "jpeg", "png", "gif"]; // Tableau des extensions de fichiers autorisées
        $upload = Utils::upload($extensions, "transporteur", $_FILES['logo']); // Upload du logo du transporteur
        $modelTransporteur = new ModelTransporteur();

        // Si le logo est uploadé...
        if ($upload['uploadOk']) {

          // Si le transporteur est ajouté...
          if ($modelTransporteur->ajoutTransporteur($_POST['nom'], $upload['file_name'])) {
            ViewTemplate::alert("success", "Le transporteur a été ajouté avec succès", "liste.php"); // Afficher le succès
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
      ViewTransporteur::ajoutTransporteur(); // Afficher le formulaire d'ajout de transporteur
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