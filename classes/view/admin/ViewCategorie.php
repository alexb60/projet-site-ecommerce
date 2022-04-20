<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelCategorie.php';

class ViewCategorie
{

  // FONCTION PERMETTANT DE LISTER LES CATÉGORIES
  public static function listeCategorie()
  {
    $categorie = new ModelCategorie();
    $liste = $categorie->listeCategorie();
?>
    <div class="container">
      <?php
      if (count($liste) > 0) {
      ?>
        <h2 class="mb-4">Liste des catégories</h2>
        <table class="table">
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
                  <a href="voir.php?id=<?= $categorie['id'] ?>" class="btn btn-primary">Voir</a>
                  <a href="modif.php?id=<?= $categorie['id'] ?>" class="btn btn-warning">Modifier</a>
                  <a href="supp.php?id=<?= $categorie['id'] ?>" class="btn btn-danger">Supprimer</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      <?php
      } else {
      ?>
        <div class="alert alert-danger" role="alert">
          Aucune catégorie n'existe dans la liste.
        </div>
      <?php
      } ?>
    </div>
  <?php
  }

  // FONCTION PERMETTANT DE VOIR LES DÉTAILS D'UNE CATÉGORIE
  public static function voirCategorie($id)
  {
    $categories = new ModelCategorie();
    $categorie = $categories->voirCategorie($id);
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
              <a href="modif.php?id=<?= $categorie['id'] ?>" class="btn btn-warning">Modifier</a>
              <a href="supp.php?id=<?= $categorie['id'] ?>" class="btn btn-danger">Supprimer</a><br><br>
              <a href="liste.php" class="btn btn-primary">← Retour</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION PERMETTANT D'AJOUTER UNE CATÉGORIE
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
              <input type="text" name="nom" id="nom" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" name="ajout" id="ajout">Ajouter</button>
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION PERMETTANT DE MODIFIER UNE CATÉGORIE
  public static function modifCategorie($id)
  {
    $categories = new ModelCategorie();
    $categorie = $categories->voirCategorie($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Modification de la catégorie <?= $categorie['nom']; ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3">
            <input type="hidden" name="id" class="form-control" id="id" value="<?= $categorie['id']; ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $categorie['nom']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="modif" id="modif">Modifier</button>
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
        </div>
      </div>

    </div>
<?php
  }
}
