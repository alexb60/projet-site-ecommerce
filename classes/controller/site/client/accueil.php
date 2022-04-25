<?php
session_start();

if (isset($_SESSION['id'])) {
  $salutation = "<h2>Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "<h2>";
  $salutation .= "<a class='btn btn-warning' href='modifClient.php'>Modifier mon profil</a> ";
  $salutation .= '<a class="btn btn-danger" href="deconnexion.php">Déconnexion</a> ';
  $salutation .= '<a class="btn btn-danger" href="supp.php">Supprimer mon compte</a>';
} else {
  header('Location: connexion-client.php');
  exit;
}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <title>Accueil</title>
</head>

<body>

  <h1>page d'accueil</h1>




  <?php
  echo $salutation;
  ?>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>

</html>