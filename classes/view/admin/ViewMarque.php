<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelMarque.php';

class ViewMarque
{
  // FONCTION AFFICHANT LA LISTE DES MARQUES
  public static function listeMarque()
  {
    $marque = new ModelMarque();
    $liste = $marque->listeMarque();
?>
    <div class="container">

      <?php
      if (count($liste) > 0) { ?>
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Liste des marques</h2>
          </div>
          <div class="col-md-6 d-flex justify-content-end align-items-start">
            <a href="ajout.php" class="btn btn-outline-success"><i class="fas fa-plus"></i>&nbsp; Ajouter une marque</a>
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
                foreach ($liste as $marque) {
                ?>
                  <tr>
                    <th scope="row"><?= $marque['id'] ?></th>
                    <td><?= $marque['nom'] ?></td>
                    <td>
                      <a href="voir.php?id=<?= $marque['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="modif.php?id=<?= $marque['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                      <a href="supp.php?id=<?= $marque['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
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
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucune marque n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UNE MARQUE
  public static function voirMarque($id)
  {
    $modelMarque = new ModelMarque();
    $marque = $modelMarque->voirMarque($id);
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
                </div>

              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../../../../images/marque/<?= $marque['logo'] ?>" alt="Logo de la marque <?= $marque['nom'] ?>" class="img-fluid image-logo">
              </div>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="liste.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
                <a href="modif.php?id=<?= $marque['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                <a href="supp.php?id=<?= $marque['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE D'AJOUT DE MARQUE
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
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="logo">Logo :</label>
              <input type="file" name="logo" id="logo" class="form-control-file">
            </div>

            <input type="submit" class="btn btn-primary" name="ajout" id="valider">
            <input type="reset" class="btn btn-danger">
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION D'UNE MARQUE
  public static function modifMarque($id)
  {
    $modelMarque = new ModelMarque();
    $marque = $modelMarque->voirMarque($id);
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Modification de la marque <?= $marque['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" class="form-control" id="id" value="<?= $marque['id'] ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $marque['nom'] ?>" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="logo">Logo :</label>
              <input type="file" name="logo" id="logo" class="form-control-file">
            </div>

            <input type="submit" class="btn btn-success" name="modif" id="valider">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a class="btn btn-primary" href="liste.php"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
<?php
  }
}
