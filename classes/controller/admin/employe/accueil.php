<?php
session_start();

require_once "../../../view/admin/ViewTemplate.php";

if (isset($_SESSION['id_employe'])) {
  $salutation = "Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " et bienvenue sur l'espace employé";
  ViewTemplate::menu();
} else {
  header('Location: connexion-employe.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil espace employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <div class="container">
    <h2><?php echo $salutation; ?></h2>
  </div>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>