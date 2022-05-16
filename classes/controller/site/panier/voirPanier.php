<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";
require_once "../panier/panier.php";

$modelProduit = new ModelProduit();
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
  session_destroy();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mon panier</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-12">
        <h2>Panier</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        if (!isset($_SESSION['panier'])) {
        ?>
          <div class="container alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i>&nbsp; Le panier est vide.</div>
      </div>
      <?php
        } else {
          $nombreDeProduits = count($_SESSION['panier']['id']); // COMPTE LE NOMBRE DE PRODUITS DIFFÉRENTS
          if ($nombreDeProduits > 0) {
      ?>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col">Prix unitaire</th>
              <th scope="col">Quantité</th>
              <th scope="col">Sous-total</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i = 0; $i < $nombreDeProduits; $i++) {
              $produit = $modelProduit->voirProduit($_SESSION['panier']['id'][$i]);
            ?>
              <tr>
                <th scope="row"><?= $produit['id'] ?></th>
                <td><?= $produit['nom'] ?></td>
                <td><?= $produit['prix'] ?> €</td>
                <td><?= $_SESSION['panier']['quantite'][$i] ?></td>
                <td><?= (float)$_SESSION['panier']['prix'][$i] * (int)$_SESSION['panier']['quantite'][$i] ?> €</td>
                <td>
                  <a href="../produit/voir.php?id=<?= $_SESSION['panier']['id'][$i] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier la quantité</a>
                  <a href="supprProduitPanier.php?id=<?= $produit['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Retirer du panier</a>
                </td>
              </tr>
            <?php
            }
            ?>
            <tr>
              <td colspan="6">
                <h1>&nbsp;</h1>
              </td>
            </tr>
            <tr>
              <th colspan="3"></th>
              <th>Total articles</th>
              <th>Montant total</th>
              <th></th>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>
                <h4><?= (quantiteProduitPanier() <= 1) ? quantiteProduitPanier() . " article" : quantiteProduitPanier() . " articles" ?></h4>
              </td>
              <td>
                <h4><?= montantPanier() ?> €</h4>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 d-flex justify-content-end">
      <a href="finaliser.php" class="btn btn-success"><i class="fas fa-euro-sign"></i>&nbsp; Finaliser ma commande</a>
      &nbsp;&nbsp;
      <a href="viderPanier.php" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Vider le panier</a>
    </div>
  <?php

          } else {
  ?>
    <div class="container alert alert-danger" role="alert"><i class="fas fa-exclamation-triangle"></i>&nbsp; Le panier est vide.</div>
<?php
          }
        }
?>
  </div>
  </div>
  <?php
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>