<?php
require_once '../../../model/ModelProduit.php';
require_once '../../../model/ModelMarque.php';
require_once '../../../model/ModelCategorie.php';

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
                <a href="voir.php?id=<?= $produit['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i> Voir</a>
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
                  <h5 class="card-title"><?= $produit['nom']; ?> </h5>
                  <p class="card-text">
                  <p><span class="font-weight-bold">Nom :</span><br /><?= $produit['nom'] ?><br /></p>
                  <p><span class="font-weight-bold">Marque :</span><br /><?= $produit['nom_marque'] ?><br /></p>
                  <p><span class="font-weight-bold">Catégorie :</span><br /><?= $produit['nom_categorie'] ?><br /></p>
                  <p><span class="font-weight-bold">Référence :</span><br /><?= $produit['ref'] ?><br /></p>
                  <p><span class="font-weight-bold">Description du produit :</span><br /><?= $produit['description'] ?><br /></p>
                  <p><span class="font-weight-bold">Prix :</span><br /><?= $produit['prix'] ?> €<br /></p>
                  <p><span class="font-weight-bold">En stock :</span><br /><?= ($produit['quantite'] == 0) ? "<div class='alert alert-danger'>Produit épuisé</div>" : $produit['quantite'] ?><br /></p>
                  </p>
                  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" <?= ($produit['quantite'] == 0) ? 'class="d-none"' : "" ?>>
                    <input type="hidden" name="id" id="id" class="form-control" value="<?= $produit['id'] ?>">
                    <div class="form-group">
                      <label for="quantite"><span class="font-weight-bold">Quantité :</span></label>
                      <div class="col-3 input-reduit">
                        <input type="number" name="quantite" id="quantite" class="form-control" min="<?= ($produit['quantite'] == 0) ? "0" : "1" ?>" max="<?= $produit['quantite'] ?>" value="<?= ($produit['quantite'] == 0) ? "0" : "1" ?>" <?= (isset($_SESSION['id']) && ($produit['quantite']) != 0) ? "" : "disabled" ?>>
                      </div>
                    </div>
                    <input type="hidden" name="prix" id="prix" class="form-control" value="<?= $produit['prix'] ?>">
                    <?= (isset($_SESSION['id'])) ? (($produit['quantite'] != 0) ? '<button type="submit" class="btn btn-success" name="ajout" id="ajout"><i class="fas fa-cart-arrow-down"></i>&nbsp; Ajouter au panier</button>' : '') : '<div class="alert alert-danger">Vous devez être connecté pour commander</div>' ?>
                  </form>

                  <br /><br /><a href="javascript:history.back()" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>

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

  // FONCTION AFFICHANT LES RÉSULTATS DE LA RECHERCHE
  public static function recherche($recherche)
  {
    $produit = new ModelProduit();
    $liste = $produit->recherche($recherche);
  ?>
    <div class="row">
      <h1 class="mb-4">Résultats de recherche pour "<?= $recherche ?>"</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php
        if (count($liste) > 0) { ?>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Marque</th>
                <th scope="col">Prix</th>
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
                  <td>
                    <a href="voir.php?id=<?= $produit['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
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
        ?>
      </div>
    </div>
    <?php
  }

  // FONCTION AFFICHANT 8 PRODUITS PAR CATÉGORIE
  public static function produitParCategorie()
  {
    $modelProduit = new ModelProduit();

    $modelCategorie = new ModelCategorie();
    $listeCategorie = $modelCategorie->listeCategorie();

    foreach ($listeCategorie as $categorie) {
      $produit = $modelProduit->produitParCategorieAccueil($categorie['id']);
      $nbProduit = count($produit); // STOCKAGE DU NOMBRE DE PRODUITS

      if (ceil($nbProduit / 3) > 3) {
        $slide = 3;
      } else {
        $slide = ceil($nbProduit / 3);
      }

      if ($nbProduit > 0) {
    ?>
        <h2 class="my-4">Dans la catégorie <?= $categorie['nom'] ?></h2>
        <div id="carouselDerniersProduits" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php
            for ($j = 0; $j < $slide; $j++) {
              if ($j == 0) {
            ?>
                <div class="carousel-item active">
                  <div class="card-deck">
                  <?php
                } else {
                  ?>
                    <div class="carousel-item">
                      <div class="card-deck">
                        <?php
                      }
                      for ($i = ($j * 3); $i < (($j + 1) * 3); $i++) {
                        if (isset($produit[$i]['id'])) {
                        ?>
                          <div class="card" style="height: 35rem;">
                            <img src="../../../../images/produit/<?= $produit[$i]['photo'] ?>" alt='Photo du produit "<?= $produit[$i]['nom'] ?>"' class="d-block mx-auto w-100 image-card">
                            <div class="card-body">
                              <h5 class="card-title"><?= $produit[$i]['nom'] ?></h5>
                              <p class="card-text"><?= (strlen($produit[$i]['description']) > 100) ? substr($produit[$i]['description'], 0, 100) . " ..." : $produit[$i]['description'] ?></p>
                              <h4 class="card-text text-right"><?= $produit[$i]['prix'] ?> €</h4>
                            </div>
                            <ul class="list-group list-group-flush border-0 mb-2">
                              <li class="list-group-item"><a href="voir.php?id=<?= $produit[$i]['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir les détails</a></li>
                            </ul>
                          </div>
                        <?php
                        } else {
                        ?>
                          <div class="card card-cache"></div>
                      <?php
                        }
                      }
                      ?>
                      </div>
                    </div>
                  <?php
                }

                  ?>
                  </div>
                </div>
                <br />
              <?php
            } else {
              ?>
                <h2 class="my-4">Dans la catégorie <?= $categorie['nom'] ?></h2>
                <div class="alert alert-danger">Aucun produit dans cette catégorie.</div>
                <br />
            <?php
            }
          }
        }

        // FONCTION AFFICHANT LES DERNIERS PRODUITS AJOUTÉS DANS LA BASE
        public static function derniersProduit()
        {
          $produit = new ModelProduit();
          $liste = $produit->derniersProduit();
            ?>
            <h2 class="mb-4">Nouveaux produits</h2>
            <div id="carouselDerniersProduits" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php
                for ($j = 0; $j < 3; $j++) {
                  if ($j == 0) {
                ?>
                    <div class="carousel-item active">
                      <div class="card-deck">
                      <?php
                    } else {
                      ?>
                        <div class="carousel-item">
                          <div class="card-deck">
                            <?php
                          }
                          for ($i = ($j * 3); $i < (($j + 1) * 3); $i++) {
                            if (isset($liste[$i]['id'])) {
                            ?>
                              <div class="card" style="height: 35rem;">
                                <img src="../../../../images/produit/<?= $liste[$i]['photo'] ?>" alt='Photo du produit "<?= $liste[$i]['nom'] ?>"' class="d-block card-img-top mx-auto w-100 image-card">
                                <div class="card-body">
                                  <h5 class="card-title"><?= $liste[$i]['nom'] ?></h5>
                                  <p class="card-text"><?= (strlen($liste[$i]['description']) > 100) ? substr($liste[$i]['description'], 0, 100) . " ..." : $liste[$i]['description'] ?></p>
                                  <h4 class="card-text text-right"><?= $liste[$i]['prix'] ?> €</h4>
                                </div>
                                <ul class="list-group list-group-flush border-0 mb-2">
                                  <li class="list-group-item"><a href="voir.php?id=<?= $liste[$i]['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir les détails</a></li>
                                </ul>
                              </div>
                            <?php
                            } else {
                            ?>
                              <div class="card card-cache"></div>
                          <?php
                            }
                          }
                          ?>
                          </div>
                        </div>
                      <?php
                    }
                      ?>
                      </div>
                    </div>
                    <br />
                <?php
              }
            }
