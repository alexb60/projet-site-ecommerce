<?php
require_once "C:/wamp64/www/projet/classes/model/ModelTransporteur.php";

class ViewPanier
{
  public static function finalisation()
  {
    $modelTransporteur = new ModelTransporteur();
    $listeTransporteur = $modelTransporteur->listeTransporteur();
?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Finalisation de la commande</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <div class="form-group">
              <label for="mode">Mode de livraison :</label>
              <select name="mode" id="mode" class="form-control" aria-describedby="modeHelp" data-type="modeSelect" data-message="Veuillez choisir un mode de livraison.">
                <option selected disabled value="">Choisissez un mode de livraison</option>
                <option value="domicile">Livraison à votre domicile</option>
                <option value="bureau de poste">Livraison au bureau de poste</option>
                <option value="point relais">Livraison en point relais</option>
              </select>
              <small id="modeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="transporteur">Transporteur :</label>
              <select name="transporteur" id="transporteur" class="form-control" aria-describedby="transporteurHelp" data-type="transporteurSelect" data-message="Veuillez choisir un transporteur.">
                <option selected disabled value="">Choisissez un transporteur</option>
                <?php
                foreach ($listeTransporteur as $transporteur) {
                ?>
                  <option value="<?= $transporteur['id'] ?>"><?= $transporteur['nom'] ?></option>
                <?php
                }
                ?>
              </select>
              <small id="transporteurHelp" class="form-text text-muted"></small>
            </div>
            <input type="submit" id="valider" class="btn btn-success">
            <input type="reset" class="btn btn-danger">
          </form>
          <a href="debloquePanier.php" class="btn btn-primary">← Retour au panier</a>
        </div>
      </div>
    </div>
  <?php
  }
  public static function paiement()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Paiement</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="col-md-6 offset-md-3">
            <input type="hidden" name="etat" id="etat" class="form-control" value="Payée">
            <button type="submit" name="valider" id="valider" class="btn btn-success btn-lg btn-block">Payer</button>
          </form>
          <a href="debloquePanier.php" class="btn btn-primary">← Retour au panier</a>
        </div>
      </div>
    </div>
<?php
  }
}
