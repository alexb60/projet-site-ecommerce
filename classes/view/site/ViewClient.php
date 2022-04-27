<?php
require_once "C:/wamp64/www/projet/classes/model/ModelClient.php";

class ViewClient
{
  // FONCTION AFFICHANT LE FORMULAIRE QUI PERMET À UN CLIENT DE S'INSCRIRE
  public static function ajoutClient()
  {
?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Inscription</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control" aria-describedby="prenomHelp" data-type="prenom" data-message="Le format du prénom n'est pas correct">
              <small class="form-text text-muted" id="prenomHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control" aria-describedby="mailHelp" data-type="mail" data-message="Le format de l'adresse mail n'est pas correct">
              <small class="form-text text-muted" id="mailHelp"></small>
            </div>
            <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial">
              <small class="form-text text-muted" id="passHelp"></small>
            </div>
            <br />
            <button type="submit" name="ajout" id="valider" class="btn btn-primary">Valider</button>
            <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE PERMETTANT À UN CLIENT DE SE CONNECTER
  public static function connexion()
  {
  ?>
    <div class="container mt-5">
      <form class="col-md-6 offset-md-3" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="login">Adresse mail :</label>
          <input type="text" class="form-control" name="login" id="login">
        </div>
        <div class="form-group">
          <label for="pass">Mot de passe :</label>
          <input type="password" class="form-control" name="pass" id="pass">
        </div>
        <button type="submit" name="connexion" class="btn btn-primary">Connexion</button>
        <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
      </form>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES INFORMATIONS DU CLIENT
  public static function voirClient($id)
  {
    $modelClient = new ModelClient();
    $client = $modelClient->voirClient($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Mes informations</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $client['prenom'] . " " . $client['nom'] ?></h5>
              <p class="card-text">
                <span class="font-weight-bold">Adresse mail :</span> <?= $client['mail'] ?><br />
                <span class="font-weight-bold">Téléphone :</span> <?= $client['tel'] ?><br />
                <span class="font-weight-bold">Adresse postale :</span><br />
                <?= $client['adresse'] . "<br />" . $client['code_post'] . " " . $client['ville'] ?>
              </p>
              <a href="modifClient.php" class="btn btn-warning">Modifier</a>
              <a href="supp.php" class="btn btn-danger">Supprimer</a><br><br>
              <a href="accueil.php" class="btn btn-primary">← Retour</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE PERMETTANT À UN CLIENT DE MODIFIER SES INFORMATIONS
  public static function modifClient($id)
  {
    $modelClient = new ModelClient();
    $client = $modelClient->voirClient($id);
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Modifier mes informations</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= $client['id'] ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct" value="<?= $client['nom'] ?>">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control" aria-describedby="prenomHelp" data-type="prenom" data-message="Le format du prénom n'est pas correct" value="<?= $client['prenom'] ?>">
              <small class="form-text text-muted" id="prenomHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control" aria-describedby="mailHelp" data-type="mail" data-message="Le format de l'adresse mail n'est pas correct" value="<?= $client['mail'] ?>">
              <small class="form-text text-muted" id="mailHelp"></small>
            </div>
            <!-- <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial" value="" disabled>
              <small class="form-text text-muted" id="passHelp"></small>
            </div> -->
            <div class="form-group">
              <label for="tel">Téléphone :</label>
              <input type="tel" name="tel" id="tel" class="form-control" aria-describedby="telHelp" data-type="tel" data-message="Le format du numéro de téléphone n'est pas correct" value="<?= $client['tel'] ?>">
              <small class="form-text text-muted" id="telHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse postale :</label>
              <input type="text" name="adresse" id="adresse" class="form-control" aria-describedby="adresseHelp" data-type="adresse" data-message="Le format de l'adresse n'est pas correct" value="<?= $client['adresse'] ?>">
              <small class="form-text text-muted" id="adresseHelp"></small>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <label for="code_post">Code postal :</label>
                <input type="text" name="code_post" id="code_post" class="form-control" aria-describedby="code_postHelp" data-type="code_post" data-message="Le code postal doit être composé de 5 chiffres" value="<?= $client['code_post'] ?>">
                <small class="form-text text-muted" id="code_postHelp"></small>
              </div>
              <div class="col-md-8">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" class="form-control" aria-describedby="villeHelp" data-type="ville" data-message="Le format de la ville n'est pas correct" value="<?= $client['ville'] ?>">
                <small class="form-text text-muted" id="villeHelp"></small>
              </div>
            </div>
            <br />
            <input type="submit" name="modif" id="valider" class="btn btn-success">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a href="accueil.php" class="btn btn-primary">← Retour</a>
        </div>
      </div>
    </div>
<?php
  }
}
