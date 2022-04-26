<?php
session_start();

require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

if (isset($_SESSION['id'])) {
  $client = new ModelClient();
  if ($client->suppClient($_SESSION['id'])) {
    session_destroy();
    $message = ["success", "Compte supprimé avec succès", "inscription.php"];
  } else {
    $message = ["danger", "Échec de la suppression", "accueil.php"];
  }
} else {
  $message = ["danger", "Le profil n'existe pas", "accueil.php"];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suppression du compte client</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php
  ViewTemplate::alert($message[0], $message[1], $message[2]);
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>