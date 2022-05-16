<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelRole.php';

class ViewRole
{

  // FONCTION AFFICHANT LA LISTE DES RÔLES
  public static function listeRole()
  {
    $role = new ModelRole();
    $liste = $role->listeRole();
?>
    <div class="container">
      <?php
      if (count($liste) > 0) {
      ?>
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Liste des rôles</h2>
          </div>
          <div class="col-md-6 d-flex justify-content-end align-items-start">
            <a href="ajout.php" class="btn btn-outline-success"><i class="fas fa-plus"></i>&nbsp; Ajouter un rôle</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($liste as $role) {
                ?>
                  <tr>
                    <th scope="row"><?= $role['id'] ?></th>
                    <td><?= $role['nom'] ?></td>
                    <td>
                      <a href="voir.php?id=<?= $role['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="modif.php?id=<?= $role['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                      <a href="supp.php?id=<?= $role['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
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
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun rôle n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UN RÔLE
  public static function voirRole($id)
  {
    $modelRole = new ModelRole();
    $role = $modelRole->voirRole($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails du rôle <?= $role['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $role['id'] . " - " . $role['nom']; ?> </h5>
              <p class="card-text"></p>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="liste.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
                <a href="modif.php?id=<?= $role['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                <a href="supp.php?id=<?= $role['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE D'AJOUT D'UN RÔLE
  public static function ajoutRole()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Ajout d'un rôle</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>

            <button type="submit" class="btn btn-primary" name="ajout" id="valider">Ajouter</button>
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION D'UN RÔLE
  public static function modifRole($id)
  {
    $modelRole = new ModelRole();
    $role = $modelRole->voirRole($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Modification du rôle <?= $role['nom']; ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" class="form-control" id="id" value="<?= $role['id']; ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $role['nom']; ?>" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>

            <button type="submit" class="btn btn-success" name="modif" id="valider">Modifier</button>
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
          <br />
          <a class="btn btn-primary" href="liste.php"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
<?php
  }
}
