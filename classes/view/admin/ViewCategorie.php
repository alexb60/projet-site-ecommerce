<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelCategorie.php';

class ViewCategorie
{
  public static function listeCategorie()
  {
    $categorie = new ModelCategorie();
    $liste = $categorie->listeCategorie();
?>
    <div class="container">
      <?php
      if (count($liste) > 0) {
      ?>
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
                  <a href="#" class="btn btn-primary">Voir</a>
                  <a href="#" class="btn btn-warning">Modifier</a>
                  <a href="#" class="btn btn-danger">Supprimer</a>
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

  public static function ajoutCategorie()
  {
  ?>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 offset-md-3">
      <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary" name="ajout" id="ajout">Ajouter</button>
      <button type="reset" class="btn btn-danger">Réinitialiser</button>
    </form>
<?php
  }
}
