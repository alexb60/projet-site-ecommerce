<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  require_once "../../../view/admin/ViewEmploye.php";
  require_once "../../../view/site/ViewTemplate.php";
  require_once "../../../view/admin/utils.php";
  require_once "../../../model/ModelEmploye.php";

  ViewTemplate::headerInvite();
  ?>
  <div class="container">
    <?php
    if (isset($_POST['nom'])) {
      $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass']];
      $types = ["nom", "prenom", "email", "pass"];
      $data = Utils::valider($donnees, $types);

      if ($data) {
        $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $user = new ModelEmploye();
        if ($user->ajoutEmploye($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['role']) && $data) {
    ?>
          <h1>Inscription réalisée avec succès</h1>
          <a href="connexion-employe.php" class="btn btn-primary">Connexion</a>
        <?php
        } else {
        ?>
          <h1>Échec de l'inscription</h1>
          <a href="inscription.php" class="btn btn-primary">← Retour</a>
        <?php
        }
      } else {
        ?>
        <h1>Échec de l'inscription</h1>
        <a href="inscription.php" class="btn btn-primary">← Retour</a>
    <?php
      }
    } else {
      ViewEmploye::ajoutEmploye();
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