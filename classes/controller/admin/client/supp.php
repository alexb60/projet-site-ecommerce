<?php
session_start();

require_once "../../../view/admin/ViewClient.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {

  ViewTemplate::menu();
  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Clients'] == "oui") {
    // Si l'id est passé en GET...
    if (isset($_GET['id'])) {
      $client = new ModelClient();
      // Si la suppression se fait...
      if ($client->suppClient($_GET['id'])) {
        ViewTemplate::alert("success", "Compte supprimé avec succès", "liste.php?page=1"); // Afficher le succès
      } else {
        ViewTemplate::alert("danger", "Échec de la suppression", "liste.php?page=1"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Le profil n'existe pas", "liste.php?page=1"); // Message d'erreur
    }
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Navbar admin invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
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