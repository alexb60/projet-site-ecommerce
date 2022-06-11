<?php
session_start();

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Suppression d'un employé");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Employés'] == "oui") {
    $employe = new ModelEmploye();

    // Si l'id de l'employé existe dans GET
    if (isset($_GET['id'])) {

      // Si l'id de l'employé est différent du super administrateur et est différent de l'id de l'employé connecté
      if (($_GET['id'] != 1) && ($_GET['id'] != $_SESSION['id_employe'])) {
        // Si l'employé est bien supprimé...
        if ($employe->suppEmploye($_GET['id'])) {
          ViewTemplate::alert("success", "Compte employé supprimé avec succès", "listeEmploye.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Échec de la suppression", "accueil.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Cet employé ne peut pas être supprimé", "listeEmploye.php"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "listeEmploye.php"); // Message d'erreur
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