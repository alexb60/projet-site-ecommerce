<?php
session_start();
require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../view/admin/utils.php";
require_once "../../../model/ModelEmploye.php";

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté
} else {
  ViewTemplate::headerInvite(); // Header admin non connecté
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajout d'un Employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <div class="container">
    <?php
    // Si le rôle permet d'accéder à cette section...
    if ($_SESSION['perm']['Catégories'] == "oui") {
      // Si le nom existe dans POST (le formulaire a été envoyé)...
      if (isset($_POST['nom'])) {
        $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass']]; // Tableau des données à vérifier
        $types = ["nom", "prenom", "email", "pass"]; // Tableau des types de données à vérifier
        $data = Utils::valider($donnees, $types); // Validation des données

        // Si les données ont été validées
        if ($data) {
          $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hashage du mot de passe
          $user = new ModelEmploye();

          // Si l'ajout de l'employé est fait...
          if ($user->ajoutEmploye($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['role']) && $data) {
            ViewTemplate::alert("success", "Employé ajouté avec succès", "listeEmploye.php"); // Afficher le succès
          } else {
            ViewTemplate::alert("danger", "Échec lors de l'ajout de l'employé", "ajoutEmploye.php"); // Afficher l'échec
          }
        } else {
          ViewTemplate::alert("danger", "Un ou plusieurs champs ne sont pas correctement remplis", "ajoutEmploye.php");
        }
      } else {
        ViewEmploye::ajoutEmploye(); // Afficher le formulaire d'ajout
      }
    } else {
      ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
    }
    ?>
  </div>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <script src="../../../../js/validation-form-admin.js"></script>
</body>

</html>