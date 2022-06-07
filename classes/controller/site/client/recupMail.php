<?php
session_start();

require_once "../../../view/site/utils.php";
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

ViewTemplate::headerInvite(); // Header invité

// Si le formulaire a été envoyé...
if (isset($_POST['mail'])) {
  $modelClient = new ModelClient();

  $donnees = [$_POST['mail']]; // Tableau contenant les données à vérifier
  $types = ["email"]; // Tableau des types de données à vérifier
  $data = Utils::valider($donnees, $types); // Vérification des données

  // Si les données sont conformes
  if ($data) {
    // Si l'adresse mail existe dans la base de données...
    if ($modelClient->recupToken($_POST['mail'])) {
      $recup = $modelClient->recupToken($_POST['mail']); // Stockage de l'adresse mail et du token associé

      // Si l'adresse mail envoyée correspond au token...
      if (password_verify($_POST['mail'], $recup['token'])) {
        $_SESSION['mail'] = $_POST['mail']; // Stokage de l'adresse mail dans $_SESSION
        header('Location: modifPass.php'); // Redirection vers la page de modification du mot de passe
      } else {
        ViewTemplate::alert("danger", "Erreur lors de la récupération de l'adresse mail", "recupMail.php"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "L'adresse mail n'existe pas", "recupMail.php"); // Message d'erreur
    }
  } else {
    ViewTemplate::alert("danger", "Veuillez entrer une adresse mail valide", "javascript:history.back()");
  }
} else {
  ViewClient::recupMail(); // Afficher le formulaire de récupération de l'adresse mail
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Récupération de l'adresse mail client</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php
  ViewTemplate::footer(); // Footer
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form.js"></script>
</body>

</html>