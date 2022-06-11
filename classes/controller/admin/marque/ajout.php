<?php
session_start();

require_once "../../../view/admin/ViewMarque.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelMarque.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Ajout d'une marque");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu();

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Marques'] == "oui") {

    // Si le formulaire a été envoyé
    if (isset($_POST['nom'])) {
      $donnees = [$_POST['nom']]; // Tableau des données à vérifier
      $types = ["nom"]; // Trableau des types de données à vérifier
      $data = Utils::valider($donnees, $types); // Validation des données

      // Si les données sont conformes...
      if ($data) {
        $extensions = ["jpg", "jpeg", "png", "gif"]; // Tableau des extensions de fichiers autorisées
        $upload = Utils::upload($extensions, "marque", $_FILES['logo']); // Upload du logo
        $modelMarque = new ModelMarque();

        // Si l'upload se fait...
        if ($upload['uploadOk']) {

          // Si l'ajout se fait...
          if ($modelMarque->ajoutMarque($_POST['nom'], $upload['file_name'])) {
            ViewTemplate::alert("success", "La marque a été ajoutée avec succès", "liste.php"); // Afficher le succès
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
      ViewMarque::ajoutMarque(); // Afficher le formulaire d'ajout d'une marque
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