<?php
require_once 'C:/wamp64/www/projet/classes/model/ModelProduit.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelMarque.php';
require_once 'C:/wamp64/www/projet/classes/model/ModelCategorie.php';

class ViewProduit
{
  // FONCTION AFFICHANT LA LISTE DES PRODUITS
  public static function listeProduit($premier, $parPage)
  {
    $produit = new ModelProduit();
    $liste = $produit->listeProduit($premier, $parPage);
    if (count($liste) > 0) { ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Marque</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($liste as $produit) {
          ?>
            <tr>
              <th scope="row"><?= $produit['id'] ?></th>
              <td><?= $produit['nom'] ?></td>
              <td><?= $produit['nom_categorie'] ?></td>
              <td><?= $produit['nom_marque'] ?></td>
              <td>
                <a href="voir.php?id=<?= $produit['id'] ?>" class="btn btn-primary">Voir</a>
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
        Aucun produit n'existe dans la liste.
      </div>
    <?php
    }
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UN PRODUIT
  public static function voirProduit($id)
  {
    $modelProduit = new ModelProduit();
    $produit = $modelProduit->voirProduit($id);
    ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails du produit <?= $produit['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row no-gutters">
              <div class="col-md-6">
                <div class="card-body">
                  <h5 class="card-title"><?= $produit['nom']; ?> </h5>
                  <p class="card-text">
                  <p><span class="font-weight-bold">Nom :</span><br /><?= $produit['nom'] ?><br /></p>
                  <p><span class="font-weight-bold">Marque :</span><br /><?= $produit['nom_marque'] ?><br /></p>
                  <p><span class="font-weight-bold">Catégorie :</span><br /><?= $produit['nom_categorie'] ?><br /></p>
                  <p><span class="font-weight-bold">Référence :</span><br /><?= $produit['ref'] ?><br /></p>
                  <p><span class="font-weight-bold">Description du produit :</span><br /><?= $produit['description'] ?><br /></p>
                  <p><span class="font-weight-bold">Prix :</span><br /><?= $produit['prix'] ?> €<br /></p>
                  <p><span class="font-weight-bold">En stock :</span><br /><?= $produit['quantite'] ?><br /></p>
                  </p>
                  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <input type="hidden" name="id" id="id" class="form-control" value="<?= $produit['id'] ?>">
                    <div class="form-group">
                      <label for="quantite"><span class="font-weight-bold">Quantité :</span></label>
                      <div class="col-3 input-reduit">
                        <input type="number" name="quantite" id="quantite" class="form-control" min="1" max="<?= $produit['quantite'] ?>" value="1" <?= (isset($_SESSION['id'])) ? "" : "disabled" ?>>
                      </div>
                    </div>
                    <input type="hidden" name="prix" id="prix" class="form-control" value="<?= $produit['prix'] ?>">
                    <?= (isset($_SESSION['id'])) ? '<button type="submit" class="btn btn-success" name="ajout" id="ajout">Ajouter au panier</button>' : '<div class="alert alert-danger">Vous devez être connecté pour commander</div>' ?>
                  </form>

                  <br /><br /><a href="liste.php?page=1" class="btn btn-primary">← Retour</a>

                </div>
              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../../../../images/produit/<?= $produit['photo'] ?>" alt='Photo du produit "<?= $produit['nom'] ?>"' class="img-fluid photo_produit">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
