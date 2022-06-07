<?php
session_start();
require_once "../../../view/admin/ViewRole.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelRole.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout d'un rôle</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();

    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Rôles'] == "oui") {
      if (isset($_POST['nom'])) {
        $donnees = [$_POST['nom']];
        $types = ["nom"];
        $data = Utils::valider($donnees, $types);

        $tabPerm = array("Produits" => $_POST['produit'], "Catégories" => $_POST['categorie'], "Marques" => $_POST['marque'], "Transporteurs" => $_POST['transporteur'], "Rôles" => $_POST['role'], "Employés" => $_POST['employe'], "Commandes" => $_POST['commande'], "Clients" => $_POST['client'], "Messages" => $_POST['message']);
        $perm = json_encode($tabPerm);

        if ($data) {
          $role = new ModelRole();
          if ($role->ajoutRole($_POST['nom'], $perm)) {
            ViewTemplate::alert("success", "Rôle ajouté avec succès", "liste.php");
          } else {
            ViewTemplate::alert("danger", "Erreur d'ajout", "ajout.php");
          }
        } else {
          ViewTemplate::alert("danger", "Erreur d'ajout", "liste.php");
        }
      } else {
        ViewRole::ajoutRole();
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