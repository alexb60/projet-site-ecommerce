<?php
require_once "../../../model/ModelEmploye.php";
require_once "../../../model/ModelRole.php";

class ViewEmploye
{
  // FONCTION AFFICHANT LE FORMULAIRE QUI PERMET D'AJOUTER UN EMPLOYÉ
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
          <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="col-md-8 offset-md-2">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct" required>
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom :</label>
              <input type="text" name="prenom" id="prenom" class="form-control" aria-describedby="prenomHelp" data-type="prenom" data-message="Le format du prénom n'est pas correct" required>
              <small class="form-text text-muted" id="prenomHelp"></small>
            </div>
            <div class="form-group">
              <label for="mail">Adresse mail :</label>
              <input type="email" name="mail" id="mail" class="form-control" aria-describedby="mailHelp" data-type="mail" data-message="Le format de l'adresse mail n'est pas correct" required>
              <small class="form-text text-muted" id="mailHelp"></small>
            </div>
            <div class="form-group">
              <label for="pass">Mot de passe :</label>
              <input type="password" name="pass" id="pass" class="form-control" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial">
              <small class="form-text text-muted" id="passHelp">Le mot de passe doit comporter au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial.</small>
            </div>
            <div class="form-group">
              <label for="pass2">Confirmation du mot de passe :</label>
              <input type="password" name="pass2" id="pass2" class="form-control">
              <small class="form-text text-muted" id="pass2Help"></small>
            </div>
            <div class="form-group">
              <label for="role">Rôle :</label>
              <select name="role" id="role" class="form-control" aria-describedby="roleHelp" data-type="role" data-message="Veuillez choisir un rôle">
                <option selected disabled value="">Choisir un rôle...</option>
                <?php
                foreach ($listeRole as $role) {
                ?>
                  <option value="<?= $role['id'] ?>"><?= $role['nom'] ?></option>
                <?php
                }
                ?>
              </select>
              <small class="form-text text-muted" id="roleHelp"></small>
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
    <div class="container">
      <h2 class="mb-4">Connexion à l'espace employé</h2>
      <div class="container mt-5">
        <form class="col-md-6 offset-md-3" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="login">Adresse mail :</label>
            <input type="text" class="form-control" name="login" id="login">
          </div>
          <div class="form-group">
            <label for="pass">Mot de passe :</label>
            <input type="password" class="form-control" name="pass" id="pass">
            <small class="text-align-right"><a href="recupMail.php">Mot de passe oublié ?</a></small>
          </div>
          <button type="submit" name="connexion" class="btn btn-primary">Connexion</button>
          <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
        </form>
      </div>
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
          <h2>Informations de l'employé <?= $employe['prenom'] . " " . $employe['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $employe['id'] . " - " . $employe['prenom'] . " " . $employe['nom'] ?></h5>
              <p class="card-text">
                <span class="font-weight-bold">Adresse mail :</span> <?= $employe['mail'] ?><br />
                <span class="font-weight-bold">Rôle :</span> <?= $employe['nom_role'] ?><br />
              </p>
              <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
              <a href="modifEmploye.php?id=<?= $employe['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
              <a href="supp.php" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE PERMETTANT DE MODIFIER LES INFORMATIONS D'UN EMPLOYÉ
  public static function modifEmploye($id)
  {
    $modelEmploye = new ModelEmploye();
    $employe = $modelEmploye->voirEmploye($id);

    $modelRole = new ModelRole();
    $listeRole = $modelRole->listeRole();
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4">Modifier mes informations</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="col-md-8 offset-md-2">
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
            <div class="form-group">
              <label for="role">Rôle :</label>
              <select name="role" id="role" class="form-control" aria-describedby="roleHelp" data-type="role" data-message="Veuillez choisir un rôle">
                <option selected disabled value="">Choisir un rôle...</option>
                <?php
                foreach ($listeRole as $role) {
                ?>
                  <option value="<?= $role['id'] ?>" <?= $role['id'] == $employe['id_role'] ? "selected" : "" ?>><?= $role['nom'] ?></option>
                <?php
                }
                ?>
              </select>
              <small class="form-text text-muted" id="roleHelp"></small>
            </div>
            <br />
            <input type="submit" name="modif" id="valider" class="btn btn-success" value="Modifier">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE PERMETTANT À UN EMPLOYÉ DE MODIFIER SES INFORMATIONS
  public static function modifEmployePerso($id)
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
          <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="col-md-8 offset-md-2">
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
            <br />
            <input type="submit" name="modif" id="valider" class="btn btn-success" value="Modifier">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LA LISTE DES EMPLOYÉS
  public static function listeEmploye()
  {
    $modelEmploye = new ModelEmploye();
    $liste = $modelEmploye->listeEmploye();
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Liste des employés</h2>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-start">
          <a href="ajoutEmploye.php" class="btn btn-outline-success"><i class="fas fa-plus"></i>&nbsp; Ajouter un employé</a>
        </div>
      </div>
      <?php
      if (count($liste) > 0) {
      ?>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Prénom</th>
                  <th scope="col">Adresse mail</th>
                  <th scope="col">Rôle</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($liste as $employe) {
                ?>
                  <tr>
                    <th scope="row"><?= $employe['id'] ?></th>
                    <td><?= $employe['nom'] ?></td>
                    <td><?= $employe['prenom'] ?></td>
                    <td><?= $employe['mail'] ?></td>
                    <td><?= $employe['role'] ?></td>
                    <td>
                      <a href="voirEmploye.php?id=<?= $employe['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="supp.php?id=<?= $employe['id'] ?>" class="btn btn-danger <?= (($employe['id'] == $_SESSION['id_employe']) || ($employe['id_role'] == 1)) ? "d-none" : "" ?>">
                        <i class="fas fa-trash-alt"></i>&nbsp; Supprimer
                      </a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php
      } else {
      ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun employé n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE RÉCUPÉRATION DE L'ADRESSE MAIL
  public static function recupMail()
  {
  ?>
    <div class="container">
      <h2 class="mb-4">Récupération de l'adresse mail</h2>
      <div class="container mt-5">
        <form class="col-md-6 offset-md-3" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="mail">Adresse mail :</label>
            <input type="email" name="mail" id="mail" class="form-control" aria-describedby="mailHelp" data-type="mail" data-message="Le format de l'adresse mail n'est pas correct">
            <small class="form-text text-muted" id="mailHelp"></small>
          </div>
          <input type="submit" name="valider" id="valider" class="btn btn-primary" />
          <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
        </form>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION DU MOT DE PASSE
  public static function modifPass()
  {
  ?>
    <div class="container">
      <h2 class="mb-4">Réinitialisation du mot de passe</h2>
      <div class="container mt-5">
        <form class="col-md-8 mx-auto" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="pass">Nouveau mot de passe :</label>
            <input type="password" class="form-control" name="pass" id="pass" aria-describedby="passHelp" data-type="pass" data-message="Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial" required>
            <small class="form-text text-muted" id="passHelp">Le mot de passe doit contenir au minimum 8 caractères dont au moins une majuscule, un chiffre et un caractère spécial.</small>
          </div>
          <div class="form-group">
            <label for="pass2">Confirmez le nouveau mot de passe :</label>
            <input type="password" class="form-control" name="pass2" id="pass2" required>
            <small class="form-text text-muted" id="pass2Help"></small>
          </div>
          <input type="submit" name="valider" id="valider" class="btn btn-primary" />
          <button type="reset" name="annuler" class="btn btn-danger">Annuler</button>
        </form>
      </div>
    </div>
<?php
  }
}
