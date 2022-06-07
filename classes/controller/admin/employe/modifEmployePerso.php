<?php
session_start();
require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelEmploye.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier mes informations employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  // Si l'employé est connecté...
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu(); // Affichage du menu

    $modelEmploye = new ModelEmploye();

    // Si l'id de l'employé n'est pas passé en POST
    if (!isset($_POST['id'])) {

      // Si la requête pour voir les infos d'un employé renvoie des données...
      if ($modelEmploye->voirEmploye($_SESSION['id_employe'])) {
        ViewEmploye::modifEmployePerso($_SESSION['id_employe']); // Afficher le formulaire de modification avec les données de l'employé
      } else {
        ViewTemplate::alert("danger", "Le profil employé n'existe pas", "accueil.php"); // Message d'erreur
      }
    } else {
      // Si l'id de l'employé est passé en POST et si la requête pour voir une catégorie renvoie des données...
      if (isset($_POST['id']) && $modelEmploye->voirEmploye($_POST['id'])) {
        $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail']]; // Tableau contenant les données à vérifier
        $types = ["nom", "prenom", "email"]; // Tableau des types de données à vérifier
        $data = Utils::valider($donnees, $types); // Vérification des données

        // Si les données sont conformes...
        if ($data) {
          $token = password_hash($_POST['mail'], PASSWORD_DEFAULT); // Création du token de récupération du mot de passe par hashage de l'adresse mail

          // Si la modification est effectuée..
          if ($modelEmploye->modifEmployePerso($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'], $token)) {
            ViewTemplate::alert("success", "Le profil employé a été modifié avec succès", "javascript:history.go(-2)"); // Afficher le succès
          } else {
            ViewTemplate::alert("danger", "Échec de la modification", "javascript:history.back()"); // Message d'erreur
          }
        } else {
          ViewTemplate::alert("danger", "Échec de la modification, les données ne sont pas conformes", "javascript:history.back()"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "javascript:history.back()"); // Message d'erreur
      }
    }
  } else {
    ViewTemplate::headerInvite(); // Navbar invité
    ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php");
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form-admin.js"></script>
</body>

</html>