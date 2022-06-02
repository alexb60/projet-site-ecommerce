<?php
session_start();
require_once "../../../view/site/ViewMessage.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/utils.php";
require_once "../../../model/ModelMessage.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php
  if (isset($_SESSION['id'])) {
    ViewTemplate::headerConnecte();
    if (isset($_POST['motif'])) {
      $donnees = [$_POST['message']];
      $types = ["description"];
      $data = Utils::valider($donnees, $types);

      if ($data) {
        $message = new ModelMessage();
        // La date et l'heure seront basés sur celles de Paris en France
        date_default_timezone_set('Europe/Paris');
        if ($message->ajoutMessageClient($_POST['motif'], date("Y-m-d H:i:s"), $_POST['message'], $_SESSION['id'])) {
          ViewTemplate::alert("success", "Message envoyé avec succès", "../client/accueil.php");
        } else {
          ViewTemplate::alert("danger", "Erreur d'envoi", "contact.php");
        }
      } else {
        ViewTemplate::alert("danger", "Erreur d'ajout", "contact.php");
      }
    } else {
      ViewMessage::ajoutMessageClient();
    }
  } else {
    ViewTemplate::headerInvite();
    ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
  }

  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script src="../../../../js/validation-form.js"></script> -->
</body>

</html>