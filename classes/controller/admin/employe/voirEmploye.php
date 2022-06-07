<?php
session_start();

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informations d'un employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  // Si l'employé est connecté...
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();
    
    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Employés'] == "oui") {
      ViewEmploye::voirEmploye($_GET['id']);
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
</body>

</html>