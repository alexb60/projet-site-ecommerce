<?php
session_start();

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";

if (isset($_SESSION['id_employe'])) {
  $employe = new ModelEmploye();
  if ($employe->suppEmploye($_SESSION['id_employe'])) {
    session_destroy();
    ViewTemplate::headerInvite();
    $message = ["success", "Compte employé supprimé avec succès", "connexion.php"];
  } else {
    ViewTemplate::headerConnecte();
    $message = ["danger", "Échec de la suppression", "accueil.php"];
  }
} else {
  ViewTemplate::headerInvite();
  $message = ["danger", "Le profil n'existe pas", "accueil.php"];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suppression du compte employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  ViewTemplate::alert($message[0], $message[1], $message[2]);
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>