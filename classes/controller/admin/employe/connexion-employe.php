<?php
session_start();

// Si l'id de l'employé existe...
if (isset($_SESSION['id_employe'])) {
  header('Location: accueil.php'); // Redirection vers l'accueil de l'espace employé
}

require_once "../../../view/admin/ViewEmploye.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";

ViewTemplate::headerInvite(); // Navbar admin invité

// Si les données ont été envoyées en POST
if (isset($_POST['connexion'])) {
  $user = new ModelEmploye();
  $userData = $user->connexionEmploye($_POST['login']); // Stockage des informations de l'utilisateur dans la variable $userData

  // S'il y a des données dans $userData et si le mot de passe correspond à celui enregistré dans la base de données...
  if ($userData && password_verify($_POST['pass'], $userData['pass'])) {
    $_SESSION['id_employe'] = $userData['id']; // Stockage de l'id de l'employé dans la variable $_SESSION
    $_SESSION['role'] = $userData['id_role']; // Stockage de l'id du rôle dans la variable $_SESSION
    // Décodage de l'objet JSON contenant les permissions en tableau associatif PHP et stockage dans la variable $_SESSION
    $_SESSION['perm'] = json_decode($userData['perm'], true);
    header('Location: accueil.php'); // Redirection vers l'accueil de l'espace employé
  } else {
    ViewTemplate::alert("danger", "L'adresse mail et le mot de passe ne correspondent pas", "connexion-employe.php"); // Message d'erreur
  }
} else {
  ViewEmploye::connexion(); // Affichage du formulaire de connexion
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion à l'espace employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  ViewTemplate::footer(); // Footer
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>