<?php
require_once '../../../model/ModelTransporteur.php';

class ViewTransporteur
{
  // FONCTION AFFICHANT LA LISTE DES TRANSPORTEURS
  public static function listeTransporteur()
  {
    $transporteur = new ModelTransporteur();
    $liste = $transporteur->listeTransporteur();
?>
    <div class="container">

      <?php
      if (count($liste) > 0) { ?>
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Liste des transporteurs</h2>
          </div>
          <div class="col-md-6 d-flex justify-content-end align-items-start">
            <a href="ajout.php" class="btn btn-outline-success"><i class="fas fa-plus"></i>&nbsp; Ajouter un transporteur</a>
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
                foreach ($liste as $transporteur) {
                ?>
                  <tr>
                    <th scope="row"><?= $transporteur['id'] ?></th>
                    <td><?= $transporteur['nom'] ?></td>
                    <td>
                      <a href="voir.php?id=<?= $transporteur['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="modif.php?id=<?= $transporteur['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                      <a href="supp.php?id=<?= $transporteur['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
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
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun transporteur n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UN TRANSPORTEUR
  public static function voirTransporteur($id)
  {
    $modelTransporteur = new ModelTransporteur();
    $transporteur = $modelTransporteur->voirTransporteur($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails du transporteur <?= $transporteur['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row no-gutters">
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title"><?= $transporteur['id'] . " - " . $transporteur['nom']; ?> </h5>
                  <p class="card-text"></p>
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../../../../images/transporteur/<?= $transporteur['logo'] ?>" alt="Logo du transporteur <?= $transporteur['nom'] ?>" class="img-fluid image-logo">
              </div>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
                <a href="modif.php?id=<?= $transporteur['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                <a href="supp.php?id=<?= $transporteur['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE D'AJOUT DE TRANSPORTEUR
  public static function ajoutTransporteur()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Ajout d'un transporteur</h2>
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

            <input type="submit" class="btn btn-primary" name="ajout" id="valider" value="Ajouter">
            <input type="reset" class="btn btn-danger">
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION D'UN TRANSPORTEUR
  public static function modifTransporteur($id)
  {
    $modelTransporteur = new ModelTransporteur();
    $transporteur = $modelTransporteur->voirTransporteur($id);
  ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2>Modification du transporteur <?= $transporteur['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" class="form-control" id="id" value="<?= $transporteur['id'] ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $transporteur['nom'] ?>" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="logo">Logo :</label>
              <input type="file" name="logo" id="logo" class="form-control-file" value="<?= $transporteur['logo'] ?>">
            </div>

            <input type="submit" class="btn btn-success" name="modif" id="valider" value="Modifier">
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
          <br />
          <a class="btn btn-primary" href="javascript:history.back()"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
<?php
  }
}
