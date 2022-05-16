<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelCategorie.php';

class ViewCategorie
{

  // FONCTION AFFICHANT LA LISTE DES CATÉGORIES
  public static function listeCategorie()
  {
    $categorie = new ModelCategorie();
    $liste = $categorie->listeCategorie();
?>
    <div class="container">
      <?php
      if (count($liste) > 0) {
      ?>
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Liste des catégories</h2>
          </div>
          <div class="col-md-6 d-flex justify-content-end align-items-start">
            <a href="ajout.php" class="btn btn-outline-success"><i class="fas fa-plus"></i>&nbsp; Ajouter une catégorie</a>
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
                foreach ($liste as $categorie) {
                ?>
                  <tr>
                    <th scope="row"><?= $categorie['id'] ?></th>
                    <td><?= $categorie['nom'] ?></td>
                    <td>
                      <a href="voir.php?id=<?= $categorie['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="modif.php?id=<?= $categorie['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                      <a href="supp.php?id=<?= $categorie['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
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
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucune catégorie n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UNE CATÉGORIE
  public static function voirCategorie($id)
  {
    $modelCategorie = new ModelCategorie();
    $categorie = $modelCategorie->voirCategorie($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails de la catégorie <?= $categorie['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $categorie['id'] . " - " . $categorie['nom']; ?> </h5>
              <p class="card-text"></p>
              <a href="liste.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
              <a href="modif.php?id=<?= $categorie['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
              <a href="supp.php?id=<?= $categorie['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE D'AJOUT D'UNE CATÉGORIE
  public static function ajoutCategorie()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Ajout d'une catégorie</h2>
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

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION D'UNE CATÉGORIE
  public static function modifCategorie($id)
  {
    $modelCategorie = new ModelCategorie();
    $categorie = $modelCategorie->voirCategorie($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Modification de la catégorie <?= $categorie['nom']; ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" class="form-control" id="id" value="<?= $categorie['id']; ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $categorie['nom']; ?>" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
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
