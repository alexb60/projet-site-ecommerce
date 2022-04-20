<?php
require_once 'C:/wamp64/www/projet/classes/model/Modelmarque.php';

class ViewMarque
{
  // FONCTION PERMETTANT DE LISTER LES MARQUES
  public static function listeMarque()
  {
    $marque = new ModelMarque();
    $liste = $marque->listeMarque();
?>
    <div class="container">
      <?php
      if (count($liste) > 0) { ?>
        <h2 class="mb-4">Liste des marques</h2>
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
            foreach ($liste as $marque) {
            ?>
              <tr>
                <th scope="row"><?= $marque['id'] ?></th>
                <td><?= $marque['nom'] ?></td>
                <td>
                  <a href="voir.php?id=<?= $marque['id'] ?>" class="btn btn-primary">Voir</a>
                  <a href="modif.php?id=<?= $marque['id'] ?>" class="btn btn-warning">Modifier</a>
                  <a href="supp.php?id=<?= $marque['id'] ?>" class="btn btn-danger">Supprimer</a>
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
          Aucune marque n'existe dans la liste.
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION PERMETTANT DE VOIR LES DÉTAILS D'UNE MARQUE
  public static function voirMarque($id)
  {
    $marques = new ModelMarque();
    $marque = $marques->voirMarque($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails de la marque <?= $marque['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row no-gutters">
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title"><?= $marque['id'] . " - " . $marque['nom']; ?> </h5>
                  <p class="card-text"></p>
                  <a href="modif.php?id=<?= $marque['id'] ?>" class="btn btn-warning">Modifier</a>
                  <a href="supp.php?id=<?= $marque['id'] ?>" class="btn btn-danger">Supprimer</a><br><br>
                  <a href="liste.php" class="btn btn-primary">← Retour</a>
                </div>
              </div>
              <div class="col-md-6">
                <img src="<?= $marque['logo'] ?>" alt="Logo de la marque <?= $marque['nom'] ?>">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION PERMETTANT D'AJOUTER UNE MARQUE
  public static function ajoutMarque()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Ajout d'une marque</h2>
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
}
