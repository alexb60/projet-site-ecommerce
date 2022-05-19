<?php
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/utils.php";
require_once "../../../model/ModelClient.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php
  ViewTemplate::headerInvite();
  ?>
  <div class="container">
    <?php
    if (isset($_POST['nom'])) {
      $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post']];
      $types = ["nom", "prenom", "email", "pass", "tel", "adresse", "ville", "code_post"];
      $data = Utils::valider($donnees, $types);

      if ($data) {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $token = password_hash($_POST['mail'], PASSWORD_DEFAULT);
        $user = new ModelClient();
        if ($user->ajoutClient($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $token) && $data) {
    ?>
          <div class="alert alert-success h3"><i class="fas fa-check"></i>&nbsp; Inscription réalisée avec succès</div>
          <a href="../produit/index.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour à l'accueil</a>
          <a href="connexion-client.php" class="btn btn-success btn-orange"><i class="fas fa-sign-in-alt"></i>&nbsp; Se connecter</a>
        <?php
        } else {
        ?>
          <div class="alert alert-danger h3"><i class="fas fa-times"></i>&nbsp; Échec lors de l'inscription</div>
          <a href="inscription.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        <?php
        }
      } else {
        ?>
        <div class="alert alert-danger h3"><i class="fas fa-times"></i>&nbsp; Échec lors de l'inscription</div>
        <a href="inscription.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
    <?php
      }
    } else {
      ViewClient::ajoutClient();
    }
    ?>
  </div>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script src="../../../../js/validation-form.js"></script> -->
</body>

</html>