<?php
session_start();

if (isset($_SESSION['id'])) {
  $salutation = "<h2>Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "<h2>";
  $salutation .= '<a class="btn btn-primary" href="voirClient.php">Voir mon profil</a> ';
  $salutation .= '<a class="btn btn-warning" href="modifClient.php">Modifier mon profil</a> ';
  $salutation .= '<a class="btn btn-danger" href="deconnexion.php">Déconnexion</a> ';
  $salutation .= '<a class="btn btn-dark" href="supp.php">Supprimer mon compte</a>';
} else {
  header('Location: connexion-client.php');
  exit;
}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <h1>Page d'accueil</h1>
  <br />
  <?php
  echo $salutation;
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>