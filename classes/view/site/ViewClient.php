<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelClient.php';

class ViewClient
{
  // FONCTION PERMETTANT À UN CLIENT DE S'INSCRIRE
  public static function inscription()
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
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data" method="post">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le nom ne doit pas contenir de chiffres ou de caractères spéciaux">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control" aria-describedby="prenomHelp" data-type="prenom" data-message="Le prénom ne doit pas contenir de chiffres ou de caractères spéciaux">
              <small class="form-text text-muted" id="prenomHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control" aria-describedby="mailHelp" data-type="mail" data-message="Le format de l'adresse mail n'est pas correct">
              <small class="form-text text-muted" id="mailHelp"></small>
            </div>
            <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control" aria-describedby="passHelp" data-message="Le mot de passe doit contenir au moins 8 caractères dont au moins une majuscules, un chiffre et un caractère spécial">
              <small class="form-text text-muted" id="passHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse postale:</label>
              <input type="text" name="adresse" id="adresse" class="form-control" aria-describedby="adresseHelp" data-type="adresse" data-message="Le format de l'adresse postale n'est pas correct">
              <small class="form-text text-muted" id="adresseHelp"></small>
            </div>
            <div class="form-row">
              <div class="col-md-4">
                <label for="code_post">Code postal :</label>
                <input type="text" name="code_post" id="code_post" class="form-control" aria-describedby="cpHelp" data-type="cp" data-message="Le format du code postal n'est pas correct">
                <small class="form-text text-muted" id="cpHelp"></small>
              </div>
              <div class="col-md-8">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville" class="form-control" aria-describedby="villeHelp" data-type="ville" data-message="La ville ne contient pas de chiffres ou de caractères spéciaux">
                <small class="form-text text-muted" id="villeHelp"></small>
              </div>
            </div>
            <div class="form-group">
              <label for="tel">Téléphone :</label>
              <input type="tel" name="tel" id="tel" class="form-control" aria-describedby="telHelp" data-type="tel" data-message="Le format du numéro de téléphone n'est pas correct">
              <small class="form-text text-muted" id="telHelp"></small>
            </div>

            <button type="submit" class="btn btn-primary" name="ajout">Valider</button>
            <button type="reset" class="btn btn-danger" name="annuler">Annuler</button>
          </form>
        </div>
      </div>
    </div>
<?php
  }
}
