<?php
session_start();

require_once "../../../view/site/utils.php";
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

ViewTemplate::headerInvite(); // Header invité

// Si l'adresse mail existe dans $_SESSION...
if (isset($_SESSION['mail'])) {

  // Si les champs pass et pass2 ont été envoyés...
  if (isset($_POST['pass']) && isset($_POST['pass2'])) {

    // Si les 2 mots de passe sont identiques...
    if ($_POST['pass'] === $_POST['pass2']) {
      // Validation serveur
      $donnees = [$_POST['pass']]; // Tableau des données à vérifier
      $types = ["pass"]; // Tableau des types de données
      $data = Utils::valider($donnees, $types); // Vérification des données

      // Si les données sont conformes...
      if ($data) {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hashage du nouveau mot de passe
        $modifPass = new ModelClient();

        // Si la modification du mot de passe est réussie...
        if ($modifPass->modifPass($_SESSION['mail'], $pass)) {
          unset($_SESSION['mail']); // Destruction de l'adresse mail dans $_SESSION
          ViewTemplate::alert("success", "Le mot de passe a été réinitialisé avec succès", "connexion-client.php"); // Afficher le succès
        } else {
          ViewTemplate::alert("danger", "Erreur lors de la réinitialisation du mot de passe", "modifPass.php"); // Message d'erreur
        }
      } else {
        ViewTemplate::alert("danger", "Erreur du format du mot de passe.<br />Le mot de passe doit contenir au moins 8 caractères dont au moins un chiffre, une majuscule et un caractère spécial.", "modifPass.php"); // Message d'erreur
      }
    } else {
      ViewTemplate::alert("danger", "Les mots de passe ne sont pas identiques", "modifPass.php"); // Message d'erreur
    }
  } else {
    ViewClient::modifPass(); // Afficher le formulaire de modification du mot de passe
  }
} else {
  ViewTemplate::alert("danger", "Accès interdit", "accueil.php"); // Message d'erreur
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réinitialisation du mot de passe client</title>
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