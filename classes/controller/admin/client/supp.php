<?php
session_start();

require_once "../../../view/admin/ViewClient.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

if (isset($_SESSION['id_employe'])) {
  if (isset($_GET['id'])) {
    $client = new ModelClient();
    if ($client->suppClient($_GET['id'])) {
      ViewTemplate::menu();
      ViewTemplate::alert("success", "Compte supprimé avec succès", "liste.php?page=1");
    } else {
      ViewTemplate::menu();
      ViewTemplate::alert("danger", "Échec de la suppression", "liste.php?page=1");
    }
  } else {
    ViewTemplate::menu();
    ViewTemplate::alert("danger", "Le profil n'existe pas", "liste.php?page=1");
  }
} else {
  ViewTemplate::headerInvite();
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php");
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
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>