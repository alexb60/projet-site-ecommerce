<?php
session_start();
require_once "../../../view/admin/ViewRole.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelRole.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'un rôle</title>
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
      $modelRole = new ModelRole();

      // Si l'id du rôle est passé en GET
      if (isset($_GET['id'])) {
        // Si la requête pour voir un rôle renvoie des données...
        if ($modelRole->voirRole($_GET['id'])) {
          ViewRole::modifRole($_GET['id']); // Afficher le formulaire avec les données du rôle à modifier
        } else {
          ViewTemplate::alert("danger", "Le rôle n'existe pas", "liste.php"); // Message d'erreur
        }
      } else {
        // Si l'id du rôle est passé en POST et si la requête pour voir un rôle renvoie des données...
        if (isset($_POST['id']) && $modelRole->voirRole($_POST['id'])) {

          // Création d'un tableau associatif contenant les valeurs des boutons radios
          $tabPerm = array("Produits" => $_POST['produit'], "Catégories" => $_POST['categorie'], "Marques" => $_POST['marque'], "Transporteurs" => $_POST['transporteur'], "Rôles" => $_POST['role'], "Employés" => $_POST['employe'], "Commandes" => $_POST['commande'], "Clients" => $_POST['client'], "Messages" => $_POST['message']);
          $perm = json_encode($tabPerm); // Encodage du tableau associatif en objet JSON

          // Si la modification du rôle se fait
          if ($modelRole->modifRole($_POST['id'], $_POST['nom'], $perm)) {
            ViewTemplate::alert("success", "Le rôle a été modifié avec succès", "javascript:history.go(-2)"); // Afficher le succès
          } else {
            ViewTemplate::alert("danger", "Échec de la modification", "liste.php"); // Message d'erreur
          }
        } else {
          ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "liste.php"); // Message d'erreur
        }
      }
    } else {
      ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
    }
  } else {
    ViewTemplate::headerInvite();
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