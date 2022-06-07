<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mes informations</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  // Si l'utilisateur est connecté...
  if (isset($_SESSION['id'])) {
    ViewTemplate::headerConnecte(); // Header client connecté
    ViewClient::voirClient($_SESSION['id']); // Affichage du profil du client
  } else {
    ViewTemplate::alert("danger", "Erreur, le profil n'existe pas", "accueil.php"); // Message d'erreur
  }
  ViewTemplate::footer(); // Footer
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>