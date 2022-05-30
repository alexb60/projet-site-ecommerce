<?php
session_start();

require_once "../../../view/admin/ViewCategorie.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelCategorie.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'une catégorie</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  // Si l'employé est connecté...
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu(); // Affichage du menu

    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Catégories'] == "oui") {
      $modelCategorie = new ModelCategorie();

      // Si l'id de la catégorie est passé en GET
      if (isset($_GET['id'])) {

        // Si la requête pour voir une catégorie renvoie des données...
        if ($modelCategorie->voirCategorie($_GET['id'])) {
          ViewCategorie::modifCategorie($_GET['id']); // Afficher le formulaire avec les données de la catégorie à modifier
        } else {
          ViewTemplate::alert("danger", "La catégorie n'existe pas", "liste.php"); // Message d'erreur
        }
      } else {
        // Si l'id de la catéogire est passé en POST et si la requête pour voir une catégorie renvoie des données...
        if (isset($_POST['id']) && $modelCategorie->voirCategorie($_POST['id'])) {
          $donnees = [$_POST['nom']]; // Tableau contenant les données à vérifier
          $types = ["nom"]; // Tableau des types de données à vérifier
          $data = Utils::valider($donnees, $types); // Vérification des données

          // Si les données sont conformes...
          if ($data) {
            // Si la modification de la catégorie se fait...
            if ($modelCategorie->modifCategorie($_POST['id'], $_POST['nom'])) {
              ViewTemplate::alert("success", "La catégorie a été modifiée avec succès", "liste.php"); // Afficher le succès
            } else {
              ViewTemplate::alert("danger", "Échec de la modification", "liste.php"); // Message d'erreur
            }
          } else {
            ViewTemplate::alert("danger", "Échec de la modification, les données ne sont pas conformes", "liste.php"); // Message d'erreur
          }
        } else {
          ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php"); // Message d'erreur
        }
      }
    } else {
      ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
    }
  } else {
    ViewTemplate::headerInvite(); // Navbar invité
    ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
  }
  ViewTemplate::footer(); // Footer
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form-admin.js"></script>

</body>

</html>