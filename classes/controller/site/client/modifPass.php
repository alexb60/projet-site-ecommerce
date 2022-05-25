<?php
session_start();

require_once "../../../view/site/utils.php";
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";

ViewTemplate::headerInvite();

// SI L'ADRESSE MAIL EXISTE DANS $_SESSION
if (isset($_SESSION['mail'])) {

  // SI LES CHAMPS PASS ET CONFIRMPASS ONT ÉTÉ ENVOYÉS
  if (isset($_POST['pass']) && isset($_POST['pass2'])) {

    // SI LES 2 MOTS DE PASSE SONT IDENTIQUES
    if ($_POST['pass'] === $_POST['pass2']) {
      // VALIDATION SERVEUR
      $donnees = [$_POST['pass']];
      $types = ["pass"];
      $data = Utils::valider($donnees, $types);

      // SI LE NOUVEAU DE MOT DE PASSE EST CONFORME
      if ($data) {
        // HASHAGE DU MOT DE PASSE
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $modifPass = new ModelClient();

        // SI LA MODIFICATION DU MOT DE PASSE EST RÉUSSIE
        if ($modifPass->modifPass($_SESSION['mail'], $pass)) {
          unset($_SESSION['mail']);
          ViewTemplate::alert("success", "Le mot de passe a été réinitialisé avec succès", "connexion-client.php");
        } else {
          ViewTemplate::alert("danger", "Erreur lors de la réinitialisation du mot de passe", "modifPass.php");
        }
      } else {
        ViewTemplate::alert("danger", "Erreur du format du mot de passe.<br />Le mot de passe doit contenir au moins 8 caractères dont au moins un chiffre, une majuscule et un caractère spécial.", "modifPass.php");
      }
    } else {
      ViewTemplate::alert("danger", "Les mots de passe ne sont pas identiques", "modifPass.php");
    }
  } else {
    ViewClient::modifPass();
  }
} else {
  ViewTemplate::alert("danger", "Accès interdit", "accueil.php");
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

<body>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form.js"></script>
</body>

</html>