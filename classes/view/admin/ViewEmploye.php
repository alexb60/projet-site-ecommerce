<?php
require_once "../../../model/ModelEmploye.php";
require_once "../../../model/ModelRole.php";

class ViewEmploye
{
  // FONCTION AFFICHANT LE FORMULAIRE QUI PERMET À UN EMPLOYÉ DE S'INSCRIRE
  public static function ajoutEmploye()
  {
    $modelRole = new ModelRole();
    $listeRole = $modelRole->listeRole();
?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Ajout d'un employé</h2>
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
            <div class="form-group">
              <label for="role">Rôle :</label>
              <select name="role" id="role" class="form-control">
                <option selected disabled value="">Choisir un rôle...</option>
                <?php
                foreach ($listeRole as $role) {
                ?>
                  <option value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                <?php
                }
                ?>
              </select>
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

  // FONCTION AFFICHANT LE FORMULAIRE PERMETTANT À UN EMPLOYÉ DE SE CONNECTER
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

  // FONCTION AFFICHANT LES INFORMATIONS DE L'EMPLOYÉ
  public static function voirEmploye($id)
  {
    $modelEmploye = new ModelEmploye();
    $employe = $modelEmploye->voirEmploye($id);
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
              <h5 class="card-title"><?= $employe['id'] . " - " . $employe['prenom'] . " " . $employe['nom'] ?></h5>
              <p class="card-text">
                <span class="font-weight-bold">Adresse mail :</span> <?= $employe['mail'] ?><br />
              </p>
              <a href="modifEmploye.php" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
              <a href="supp.php" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a><br><br>
              <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE PERMETTANT À UN EMPLOYÉ DE MODIFIER SES INFORMATIONS
  public static function modifEmploye($id)
  {
    $modelEmploye = new ModelEmploye();
    $employe = $modelEmploye->voirEmploye($id);
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
            <input type="hidden" name="id" id="id" class="form-control" value="<?= $employe['id'] ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct" value="<?= $employe['nom'] ?>">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control" aria-describedby="prenomHelp" data-type="prenom" data-message="Le format du prénom n'est pas correct" value="<?= $employe['prenom'] ?>">
              <small class="form-text text-muted" id="prenomHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control" aria-describedby="mailHelp" data-type="mail" data-message="Le format de l'adresse mail n'est pas correct" value="<?= $employe['mail'] ?>">
              <small class="form-text text-muted" id="mailHelp"></small>
            </div>
            <!-- <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial" value="" disabled>
              <small class="form-text text-muted" id="passHelp"></small>
            </div> -->
            <br />
            <input type="submit" name="modif" id="valider" class="btn btn-success">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
<?php
  }
}
