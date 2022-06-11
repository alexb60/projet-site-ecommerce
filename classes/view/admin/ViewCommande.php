<?php
require_once '../../../model/ModelCommande.php';

class ViewCommande
{
  // FONCTION AFFICHANT LA LISTE DES COMMANDES
  public static function listeCommande($premier, $parPage)
  {
    $commandes = new ModelCommande();
    $liste = $commandes->listeCommande($premier, $parPage);
?>
    <div class="row">
      <div class="col-md-12">
        <h2 class="mb-4">Liste des commandes</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        if (count($liste) > 0) {
        ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">N° Commande</th>
                <th scope="col">N° Client</th>
                <th scope="col">Date</th>
                <th scope="col">État</th>
                <th scope="col">Montant</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($liste as $commande) {
              ?>
                <tr class="<?= ($commande['etat'] == "Payée") ? "alert-danger" : (($commande['etat'] == "En préparation") ? "alert-warning" : (($commande['etat'] == 'Livrée') ? "alert-success" : (($commande['etat'] == 'Expédiée') ? "alert-primary" : "alert-dark"))) ?>">
                  <th scope="row"><?= $commande['id'] ?></th>
                  <td><?= $commande['id_client'] ?></td>
                  <td><?= $commande['date'] ?></td>
                  <td><?= $commande['etat'] ?></td>
                  <td><?= number_format($commande['montant'], 2, ',', ' ') ?> €</td>
                  <td>
                    <a href="voirDetails.php?id_com=<?= $commande['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir les détails</a>
                    <a href="modifEtat.php?id=<?= $commande['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier l'état</a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        <?php
        } else {
          ViewTemplate::alert("danger", "Aucune commande n'existe dans la liste.");
        }
        ?>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UNE COMMANDE
  public static function voirDetails($id_commande)
  {
    $modelCommande = new ModelCommande();
    $listeDetails = $modelCommande->voirDetails($id_commande);
    $commande = $modelCommande->voirCommande($_GET['id_com']);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails de la commande n°<?= $_GET['id_com'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p>
            <span class="font-weight-bold">N° client : </span><?= $commande['id_client'] ?><br />
            <span class="font-weight-bold">Nom du client : </span><?= $commande['prenom_client'] . " " . $commande['nom_client'] ?><br />
            <span class="font-weight-bold">Date de commande : </span><?= $commande['date'] ?><br />
            <span class="font-weight-bold">État : </span><?= $commande['etat'] ?><br />
            <span class="font-weight-bold">Mode de livraison : </span>Livraison au <?= $commande['mode'] ?><br />
            <span class="font-weight-bold">Transporteur : </span><?= $commande['nom_transporteur'] ?><br />
            <?= $commande['etat'] == "Retournée" ? "<br /><span class='font-weight-bold'>Motif de retour : </span>" . $commande['motifRetour'] . "<br />" : "" ?>
            <br />
            <span class="font-weight-bold">Produits commandés :</span>
          </p>
          <?php
          if (count($listeDetails) > 0) {
            $qteProduit = 0;
            $total = 0;
          ?>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom du produit</th>
                  <th scope="col">Réf.</th>
                  <th scope="col">Marque</th>
                  <th scope="col">Catégorie</th>
                  <th scope="col">Prix unitaire</th>
                  <th scope="col">Quantité</th>
                  <th scope="col">Sous-total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($listeDetails as $detail) {
                  $qteProduit += $detail['quantite'];
                  $total += ((int)$detail['quantite'] * (float)$detail['prix']);
                ?>
                  <tr>
                    <th scope="row"><?= $detail['id_produit'] ?></th>
                    <td><?= $detail['nom_produit'] ?></td>
                    <td><?= $detail['ref'] ?></td>
                    <td><?= $detail['nom_marque'] ?></td>
                    <td><?= $detail['nom_categorie'] ?></td>
                    <td><?= number_format($detail['prix'], 2, ',', ' ') ?> €</td>
                    <td><?= $detail['quantite'] ?></td>
                    <td><?= number_format(((int)$detail['quantite'] * (float)$detail['prix']), 2, ',', ' ') ?> €</td>
                  </tr>
                <?php
                }
                ?>
                <tr>
                  <td colspan="8">
                    <h1>&nbsp;</h1>
                  </td>
                </tr>
                <tr>
                  <th colspan="6"></th>
                  <th>Total articles</th>
                  <th>Montant total</th>
                </tr>
                <tr>
                  <td colspan="6"></td>
                  <td>
                    <h4><?= ($qteProduit <= 1) ? $qteProduit . " article" : $qteProduit . " articles" ?></h4>
                  </td>
                  <td>
                    <h4><?= number_format($total, 2, ',', ' ') ?> €</h4>
                  </td>
                </tr>
              </tbody>
            </table>
          <?php
          } else {
          ?>
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun produit n'existe dans la liste.
            </div>
          <?php
          }
          ?>
          <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour à la liste des commandes</a>
          <a href="modifEtat.php?id=<?= $_GET['id_com'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier l'état</a>
        </div>
      </div>
    </div>
  <?php
  }

  public static function modifEtat($id_commande)
  {
    $modelCommande = new ModelCommande();
    $commande = $modelCommande->voirCommande($id_commande);

  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Modification de l'état de la commande n°<?= $commande['id'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modifEtat.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?= $commande['id'] ?>">
            <div class="form-group">
              <label for="etat">État de la commande :</label>
              <select name="etat" id="etat" class="form-control" aria-describedby="etatHelp" data-type="etatSelect" data-message="Veuillez choisir un état.">
                <option value="" selected disabled>Choisissez un état</option>
                <option value="Payée" <?= ($commande['etat'] == "Payée") ? "selected" : "" ?>>Payée</option>
                <option value="En préparation" <?= ($commande['etat'] == "En préparation") ? "selected" : "" ?>>En préparation</option>
                <option value="Expédiée" <?= ($commande['etat'] == "Expédiée") ? "selected" : "" ?>>Expédiée</option>
                <option value="Livrée" <?= ($commande['etat'] == "Livrée") ? "selected" : "" ?>>Livrée</option>
                <option value="Retounée" <?= ($commande['etat'] == "Retournée") ? "selected" : "" ?>>Retounée</option>
              </select>
              <small id="etatHelp" class="form-text text-muted"></small>
            </div>

            <input type="submit" id="valider" class="btn btn-success">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour à la liste des commandes</a>
        </div>
      </div>
    </div>
<?php
  }
}
