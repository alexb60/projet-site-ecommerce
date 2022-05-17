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
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Marque</th>
            <th scope="col">Réf.</th>
            <th scope="col">Stock</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($liste as $produit) {
          ?>
            <tr>
              <th scope="row"><?= $produit['id'] ?></th>
              <td>
                <a class="lien-mort" data-toggle="tooltip" title="<?= $produit['nom'] ?>" data-placement="down">
                  <?= $produit['nom'] ?>
                </a>
              </td>
              <td>
                <a class="lien-mort" data-toggle="tooltip" title="<?= $produit['nom_categorie'] ?>" data-placement="down">
                  <?= (strlen($produit['nom_categorie']) > 12) ? substr($produit['nom_categorie'], 0, 12) . "..." : $produit['nom_categorie'] ?>
                </a>
              </td>
              <td>
                <a class="lien-mort" data-toggle="tooltip" title="<?= $produit['nom_marque'] ?>" data-placement="down">
                  <?= (strlen($produit['nom_marque']) > 12) ? substr($produit['nom_marque'], 0, 12) . "..." : $produit['nom_marque'] ?>
                </a>
              </td>
              <td>
                <a class="lien-mort" data-toggle="tooltip" title="<?= $produit['ref'] ?>" data-placement="down">
                  <?= (strlen($produit['ref']) > 12) ? substr($produit['ref'], 0, 12) . "..." : $produit['ref'] ?>
                </a>
              </td>
              <td <?= ($produit['quantite'] == 0) ? 'class="bg-danger text-white"' : (($produit['quantite'] <= 5) ? 'class="bg-warning"' : "") ?>>
                <?= $produit['quantite'] ?>
              </td>
              <td>
                <a href="voir.php?id=<?= $produit['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                <a href="modif.php?id=<?= $produit['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="supp.php?id=<?= $produit['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
        <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun produit n'existe dans la liste.
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
                  <h5 class="card-title"><?= $produit['id'] . " - " . $produit['nom']; ?> </h5>
                  <p class="card-text">
                  <p><span class="font-weight-bold">Nom :</span><br /><?= $produit['nom'] ?><br /></p>
                  <p><span class="font-weight-bold">Marque :</span><br /><?= $produit['nom_marque'] ?><br /></p>
                  <p><span class="font-weight-bold">Catégorie :</span><br /><?= $produit['nom_categorie'] ?><br /></p>
                  <p><span class="font-weight-bold">Référence :</span><br /><?= $produit['ref'] ?><br /></p>
                  <p><span class="font-weight-bold">Description du produit :</span><br /><?= $produit['description'] ?><br /></p>
                  <p><span class="font-weight-bold">Prix :</span><br /><?= $produit['prix'] ?> €<br /></p>
                  <p><span class="font-weight-bold">Quantité en stock :</span><br /><?= $produit['quantite'] ?><br /></p>
                  </p>
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="../../../../images/produit/<?= $produit['photo'] ?>" alt='Photo du produit "<?= $produit['nom'] ?>"' class="img-fluid photo_produit">
              </div>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="liste.php?page=1" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
                <a href="modif.php?id=<?= $produit['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                <a href="supp.php?id=<?= $produit['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE D'AJOUT DE PRODUIT
  public static function ajoutProduit()
  {
    $modelMarque = new ModelMarque();
    $listeMarque = $modelMarque->listeMarque();

    $modelCategorie = new ModelCategorie();
    $listeCategorie = $modelCategorie->listeCategorie();
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Ajout d'un produit</h2>
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
              <label for="ref">Référence :</label>
              <input type="text" name="ref" id="ref" class="form-control" aria-describedby="refHelp" data-type="ref" data-message="Le format de la référence n'est pas correct">
              <small class="form-text text-muted" id="refHelp"></small>
            </div>
            <div class="form-group">
              <label for="description">Description :</label>
              <textarea name="description" id="description" class="form-control" cols="30" rows="4"></textarea>
            </div>
            <div class="form-group">
              <label for="quantite">Quantité :</label>
              <input type="number" name="quantite" id="quantite" min="0" class="form-control" aria-describedby="quantiteHelp" data-type="quantite" data-message="La quantité doit être un nombre entier">
              <small class="form-text text-muted" id="quantiteHelp"></small>
            </div>
            <div class="form-group">
              <label for="prix">Prix :</label>
              <input type="text" name="prix" id="prix" class="form-control" aria-describedby="prixHelp" data-type="prix" data-message="Le prix doit être au format : 0.00">
              <small class="form-text text-muted" id="prixHelp"></small>
            </div>
            <div class="form-group">
              <label for="marque">Marque :</label>
              <select name="marque" id="marque" class="form-control">
                <option selected disabled value="">Choisir une marque...</option>
                <?php
                foreach ($listeMarque as $marque) {
                ?>
                  <option value="<?= $marque['id'] ?>"><?= $marque['nom'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="categorie">Catégorie :</label>
              <select name="categorie" id="categorie" class="form-control">
                <option selected disabled value="">Choisir une catégorie...</option>
                <?php
                foreach ($listeCategorie as $categorie) {
                ?>
                  <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="photo">Photo du produit :</label>
              <input type="file" name="photo" id="photo" class="form-control-file">
            </div>
            <br />
            <input type="submit" class="btn btn-primary" name="ajout" id="valider">
            <input type="reset" class="btn btn-danger">
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION D'UN PRODUIT
  public static function modifProduit($id)
  {
    $modelProduit = new ModelProduit();
    $produit = $modelProduit->voirProduit($id);

    // POUR INCLURE LES MARQUES
    $modelMarque = new ModelMarque();
    $listeMarque = $modelMarque->listeMarque();

    // POUR INCLURE LES CATÉGORIES
    $modelCategorie = new ModelCategorie();
    $listeCategorie = $modelCategorie->listeCategorie();
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Modification du produit <?= $produit['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= $produit['id'] ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $produit['nom'] ?>" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>
            <div class="form-group">
              <label for="ref">Référence :</label>
              <input type="text" name="ref" id="ref" class="form-control" value="<?= $produit['ref'] ?>" aria-describedby="refHelp" data-type="ref" data-message="Le format de la référence n'est pas correct">
              <small class="form-text text-muted" id="refHelp"></small>
            </div>
            <div class="form-group">
              <label for="description">Description :</label>
              <textarea name="description" id="description" class="form-control" cols="30" rows="4"><?= $produit['description'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="quantite">Quantité :</label>
              <input type="number" name="quantite" id="quantite" min="0" class="form-control" value="<?= $produit['quantite'] ?>" aria-describedby="quantiteHelp" data-type="quantite" data-message="La quantité doit être un nombre entier">
              <small class="form-text text-muted" id="quantiteHelp"></small>
            </div>
            <div class="form-group">
              <label for="prix">Prix :</label>
              <input type="text" name="prix" id="prix" class="form-control" value="<?= $produit['prix'] ?>" aria-describedby="prixHelp" data-type="prix" data-message="Le prix doit être au format : 0.00">
              <small class="form-text text-muted" id="prixHelp"></small>
            </div>
            <div class="form-group">
              <label for="marque">Marque :</label>
              <select name="marque" id="marque" class="form-control">
                <option disabled value="">Choisir une marque...</option>
                <?php
                foreach ($listeMarque as $marque) {
                ?>
                  <option value="<?= $marque['id'] ?>" <?= ($marque['id'] == $produit['id_marque']) ? "selected" : "" ?>><?= $marque['nom'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="categorie">Catégorie :</label>
              <select name="categorie" id="categorie" class="form-control">
                <option disabled value="">Choisir une catégorie...</option>
                <?php
                foreach ($listeCategorie as $categorie) {
                ?>
                  <option value="<?= $categorie['id'] ?>" <?= ($categorie['id'] == $produit['id_categorie']) ? "selected" : "" ?>><?= $categorie['nom'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="photo">Photo du produit :</label>
              <input type="file" name="photo" id="photo" class="form-control-file" value="<?= $produit['photo'] ?>">
            </div>
            <br />
            <input type="submit" class="btn btn-primary" name="ajout" id="valider">
            <input type="reset" class="btn btn-danger">
          </form>
          <br />
          <a class="btn btn-primary" href="liste.php"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
    <?php
  }

  // FONCTION AFFICHANT LES RÉSULTATS DE LA RECHERCHE
  public static function recherche($recherche)
  {
    $produit = new ModelProduit();
    $liste = $produit->recherche($recherche);
    if (count($liste) > 0) { ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Catégorie</th>
            <th scope="col">Marque</th>
            <th scope="col">Prix</th>
            <th scope="col">Stock</th>
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
              <td><?= $produit['prix'] ?></td>
              <td <?= ($produit['quantite'] == 0) ? 'class="bg-danger text-white"' : (($produit['quantite'] <= 5) ? 'class="bg-warning"' : "") ?>>
                <?= $produit['quantite'] ?>
              </td>
              <td>
                <a href="voir.php?id=<?= $produit['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                <a href="modif.php?id=<?= $produit['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                <a href="supp.php?id=<?= $produit['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
        <i class="fas fa-times"></i>&nbsp; Aucun résultat trouvé.
      </div>
<?php
    }
  }
}
