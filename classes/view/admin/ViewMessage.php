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
            <th scope="col">Date</th>
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
              <td><?= $message['date'] ?></td>
              <td>
                <a href="voir.php?id=<?= $message['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                <a href="reponse.php?rep=<?= $message['id'] ?>" class="btn btn-info"><i class="fas fa-reply"></i>&nbsp; Répondre</a>
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
                <span class="font-weight-bold">Date :</span> <?= $message['date'] ?><br />
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

  public static function reponse()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Répondre à un client</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
              <label for="message">Message :</label>
              <textarea name="message" id="message" class="form-control" cols="30" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="ajout" id="valider">Envoyer</button>
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
        </div>
      </div>
    </div>
<?php
  }
}
