<?php
session_start();

require_once "../../../view/admin/ViewCommande.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modification d'une catégorie</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id_employe'])) {
    ViewTemplate::menu();

    $modelCommande = new ModelCommande();
    if (isset($_GET['id'])) {
      if ($modelCommande->voirCommande($_GET['id'])) {
        ViewCommande::modifEtat($_GET['id']);
      } else {
        ViewTemplate::alert("danger", "La commande n'existe pas", "listeCommande.php");
      }
    } else {
      if (isset($_POST['id']) && $modelCommande->voirCommande($_POST['id'])) {
        if (!$modelCommande->modifEtat($_POST['id'], $_POST['etat'])) {
          ViewTemplate::alert("success", "L'état de la commande a été modifié avec succès", "listeCommande.php");
        } else {
          ViewTemplate::alert("danger", "Échec de la modification", "listeCommande.php");
        }
      } else {
        ViewTemplate::alert("danger", "Aucune donnée n'a été transmise", "listeCommande.php");
      }
    }
  } else {
    ViewTemplate::headerInvite();
  ?>
    <div class="container">
      <?php
      ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php");
      ?>
    </div>
  <?php
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script src="../../../../js/validation-form.js"></script> -->

</body>

</html>