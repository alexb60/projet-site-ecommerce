<?php
require_once "C:/wamp64/www/projet/classes/model/ModelClient.php";

class ViewClient
{
  // FONCTION PERMETTANT À UN CLIENT DE S'INSCRIRE
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
              <input type="text" name="nom" id="nom" class="form-control">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control">
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control">
            </div>
            <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control">
            </div>
            <!-- <div class="form-group">
              <label for="tel">Téléphone :</label>
              <input type="tel" name="tel" id="tel" class="form-control">
            </div>
            <div class="form-group">
              <label for="mail">Adresse postale :</label>
              <input type="text" name="adresse" id="adresse" class="form-control">
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <label for="code_post">Code postal :</label>
                <input type="text" name="code_post" id="code_post" class="form-control">
              </div>
              <div class="col-md-8">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" class="form-control">
              </div>
            </div> -->
            <br />
            <button type="submit" name="ajout" class="btn btn-primary">Valider</button>
            <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }

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

  public static function modifClient($id)
  {
    $client = new ModelClient();
    $user = $client->voirClient($id);
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Modifier vos informations</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="modifClient.php" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $user['nom'] ?>">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $user['prenom'] ?>">
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control" value="<?= $user['mail'] ?>">
            </div>
            <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control" value="<?= $user['pass'] ?>" disabled>
            </div>
            <div class="form-group">
              <label for="tel">Téléphone :</label>
              <input type="tel" name="tel" id="tel" class="form-control" value="<?= $user['tel'] ?>">
            </div>
            <div class="form-group">
              <label for="mail">Adresse postale :</label>
              <input type="text" name="adresse" id="adresse" class="form-control" value="<?= $user['adresse'] ?>">
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <label for="code_post">Code postal :</label>
                <input type="text" name="code_post" id="code_post" class="form-control" value="<?= $user['code_post'] ?>">
              </div>
              <div class="col-md-8">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" class="form-control" value="<?= $user['ville'] ?>">
              </div>
            </div>
            <br />
            <button type="submit" name="modif" class="btn btn-primary">Modifier</button>
            <button type="reset" class="btn btn-danger">Annuler</button>
          </form>
        </div>
      </div>
    </div>
<?php
  }
}
