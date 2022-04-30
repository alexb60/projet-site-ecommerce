<?php
session_start();

require_once "../../../view/admin/ViewClient.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu();
  ViewEmploye::voirEmploye($_SESSION['id_employe']);
} else {
  ViewTemplate::alert("danger", "Erreur, le profil n'existe pas", "accueil.php");
}
ViewTemplate::footer();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes informations employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>