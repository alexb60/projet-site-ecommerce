<?php
require_once '../../../model/ModelMessage.php';

class ViewMessage
{
  public static function listeMessageClient($premier, $parPage)
  {
    $message = new ModelMessage();
    $liste = $message->listeMessageClient($premier, $parPage);
    if (count($liste) > 0) { ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">N° client</th>
            <th scope="col">Nom du client</th>
            <th scope="col">Prénom du client</th>
            <th scope="col">Adresse mail</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($liste as $message) {
          ?>
            <tr>
              <th scope="row"><?= $message['id_client'] ?></th>
              <td><?= $message['nom_client'] ?></td>
              <td><?= $message['prenom_client'] ?></td>
              <td><?= $message['mail'] ?></td>
              <td>
                <a href="voir.php?id=<?= $message['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir le message</a>
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
        Aucun message dans la liste.
      </div>
    <?php
    }
  }

  // FONCTION AFFICHANT LE MESSAGE ENVOYÉ PAR UN CLIENT
  public static function voirMessageClient($id)
  {
    $modelMessage = new ModelMessage();
    $message = $modelMessage->voirMessageClient($id);
    ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Message n°<?= $message['id'] ?> du client n°<?= $message['id_client'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $message['id_client'] . " - " . $message['prenom_client'] . " " . $message['nom_client'] ?></h5>
              <p class="card-text">
                <span class="font-weight-bold">Adresse mail :</span> <?= $message['mail'] ?><br />
                <span class="font-weight-bold">Motif de contact :</span> <?= $message['type'] ?><br />
                <br />
                <span class="font-weight-bold">Message :</span><br /><?= $message['message'] ?>
              </p>
              <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
