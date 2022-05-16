<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelCategorie.php';

class ViewClient
{
  // FONCTION AFFICHANT LA LISTE DES CLIENTS
  public static function listeClient($premier, $parPage)
  {
    $modelClient = new ModelClient();
    $liste = $modelClient->listeClient($premier, $parPage);
?>
    <div class="container">
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
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($liste as $client) {
                ?>
                  <tr>
                    <th scope="row"><?= $client['id'] ?></th>
                    <td><?= $client['nom'] ?></td>
                    <td><?= $client['prenom'] ?></td>
                    <td><?= $client['mail'] ?></td>
                    <td>
                      <a href="voir.php?id=<?= $client['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="supp.php?id=<?= $client['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
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
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun client n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES INFORMATIONS DU CLIENT
  public static function voirClient($id)
  {
    $modelClient = new ModelClient();
    $client = $modelClient->voirClient($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Informations du client n°<?= $client['id'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $client['prenom'] . " " . $client['nom'] ?></h5>
              <p class="card-text">
                <span class="font-weight-bold">Adresse mail :</span> <?= $client['mail'] ?><br />
                <span class="font-weight-bold">Téléphone :</span> <?= $client['tel'] ?><br />
                <span class="font-weight-bold">Adresse postale :</span><br />
                <?= $client['adresse'] . "<br />" . $client['code_post'] . " " . $client['ville'] ?>
              </p>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="liste.php?page=1" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
                <a href="supp.php?id=<?= $client['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
