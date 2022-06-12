<?php
require_once "../../../view/site/ViewClient.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/utils.php";
require_once "../../../model/ModelClient.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Inscription");

ViewTemplate::headerInvite(); // Header invité

// Si le formulaire est envoyé...
if (isset($_POST['nom'])) {
  // Tableau des données à vérifier
  $donnees = [$_POST['nom'], $_POST['prenom'], $_POST['mail'], $_POST['pass'], $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post']];
  $types = ["nom", "prenom", "email", "pass", "tel", "adresse", "ville", "code_post"]; // Tableau des types de données à vérifier
  $data = Utils::valider($donnees, $types); // Validation des données

  // Si les données sont conformes...
  if ($data) {

    // Si les 2 mots de passes sont identiques...
    if ($_POST['pass'] === $_POST['pass2']) {
      $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hashage du mot de passe
      $token = password_hash($_POST['mail'], PASSWORD_DEFAULT); // Hashage de l'adresse mail pour créer le token de récupération du mot de passe
      $user = new ModelClient();

      // Si l'inscription se fait...
      if ($user->ajoutClient($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['tel'], $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $token) && $data) {
?>
        <!-- Message de succès -->
        <div class="container">
          <div class="alert alert-success h3"><i class="fas fa-check"></i>&nbsp; Inscription réalisée avec succès</div>
          <a href="../produit/index.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour à l'accueil</a>
          <a href="connexion-client.php" class="btn btn-success btn-orange"><i class="fas fa-sign-in-alt"></i>&nbsp; Se connecter</a>
        </div>
      <?php
      } else {
      ?>
        <!-- Message d'échec -->
        <div class="container">
          <div class="alert alert-danger h3"><i class="fas fa-times"></i>&nbsp; Échec lors de l'inscription</div>
          <a href="inscription.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
    <?php
      }
    } else {
      ViewTemplate::alert("danger", "Les mots de passes doivent être identiques", "javascript:history.back()"); // Message d'erreur
    }
  } else {
    ?>
    <!-- Message d'échec -->
    <div class="container">
      <div class="alert alert-danger h3"><i class="fas fa-times"></i>&nbsp; Échec lors de l'inscription</div>
      <a href="inscription.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
    </div>
<?php
  }
} else {
  ViewClient::ajoutClient(); // Afficher le formulaire d'inscription
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(true); // Scripts JS et fermeture du body et de html