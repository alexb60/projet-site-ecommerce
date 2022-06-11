<?php
require_once '../../../model/ModelCategorie.php';

class ViewClient
{
  // FONCTION AFFICHANT LA LISTE DES CLIENTS
  public static function listeClient($premier, $parPage)
  {
    $modelClient = new ModelClient();
    $liste = $modelClient->listeClient($premier, $parPage);
?>
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-4">Liste des clients</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        if (count($liste) > 0) {
        ?>
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
        <?php
        } else {
          ViewTemplate::alert("danger", "Aucun client n'existe dans la liste.");
        }
        ?>
      </div>
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
              <h5 class="card-title"><i class="fas fa-user"></i>&nbsp; <?= $client['prenom'] . " " . $client['nom'] ?></h5>
              <p class="card-text">
                <span class="font-weight-bold"><i class="fas fa-envelope"></i>&nbsp; Adresse mail :</span> <?= $client['mail'] ?><br />
                <span class="font-weight-bold"><i class="fas fa-phone-alt"></i>&nbsp; Téléphone :</span> <?= $client['tel'] ?><br /><br />
                <span class="font-weight-bold"><i class="fas fa-map-marker-alt"></i>&nbsp; Adresse postale :</span><br />
                <?= $client['adresse'] . "<br />" . $client['code_post'] . " " . $client['ville'] ?>
              </p>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
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
