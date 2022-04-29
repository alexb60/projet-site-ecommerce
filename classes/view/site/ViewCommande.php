<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelProduit.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelMarque.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelCategorie.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelTransporteur.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelCommande.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelClient.php';

class ViewCommande
{
  // FONCTION AFFICHANT LA LISTE DES CATÉGORIES
  public static function listeCommandeClient($id_client)
  {
    $commandes = new ModelCommande();
    $liste = $commandes->listeCommandeClient($id_client);
?>
    <?php
    if (count($liste) > 0) {
    ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">N° Commande</th>
            <th scope="col">Date</th>
            <th scope="col">État</th>
            <th scope="col">Montant</th>
            <th scope="col">Lieu de livraison</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($liste as $commande) {
          ?>
            <tr>
              <th scope="row"><?= $commande['id'] ?></th>
              <td><?= $commande['date'] ?></td>
              <td><?= ucfirst($commande['etat'])  ?></td>
              <td><?= $commande['montant'] ?> €</td>
              <td><?= ucfirst($commande['mode']) ?></td>
              <td>
                <a href="voirDetails.php?id_com=<?= $commande['id'] ?>" class="btn btn-primary">Voir les détails</a>
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
        Aucune commande n'existe dans la liste.
      </div>
    <?php
    }
  }

  public static function voirDetailsClient($id_commande)
  {
    $modelCommande = new ModelCommande();
    $listeDetails = $modelCommande->voirDetails($id_commande);
    $commande = $modelCommande->voirCommande($_GET['id_com']);

    $modelClient = new ModelClient();
    $client = $modelClient->voirClient($_SESSION['id']);

    $modelTransporteur = new ModelTransporteur();
    $transporteur = $modelTransporteur->voirTransporteur($commande['id_transporteur']);
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
            <span class="font-weight-bold">N° client : </span><?= $_SESSION['id'] ?><br />
            <span class="font-weight-bold">Nom du client : </span><?= $client['prenom'] . " " . $client['nom'] ?><br />
            <span class="font-weight-bold">Date de commande : </span><?= $commande['date'] ?><br />
            <span class="font-weight-bold">État : </span><?= $commande['etat'] ?><br />
            <span class="font-weight-bold">Mode de livraison : </span>Livraison au <?= $commande['mode'] ?><br />
            <span class="font-weight-bold">Transporteur : </span><?= $transporteur['nom'] ?><br />
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
                    <td><?= $detail['prix'] ?> €</td>
                    <td><?= $detail['quantite'] ?></td>
                    <td><?= (int)$detail['quantite'] * (float)$detail['prix'] ?> €</td>
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
                    <h4><?= $total ?> €</h4>
                  </td>
                </tr>
              </tbody>
            </table>
          <?php
          } else {
          ?>
            <div class="alert alert-danger" role="alert">
              Aucun produit n'existe dans la liste.
            </div>
          <?php
          }
          ?>
          <a href="listeCommandeClient.php" class="btn btn-primary">← Retour à la liste des commandes</a>
        </div>
      </div>
    </div>
<?php
  }
}