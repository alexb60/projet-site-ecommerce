<?php
require_once '../../../model/ModelRole.php';

class ViewRole
{

  // FONCTION AFFICHANT LA LISTE DES RÔLES
  public static function listeRole()
  {
    $role = new ModelRole();
    $liste = $role->listeRole();
?>
    <div class="container">
      <?php
      if (count($liste) > 0) {
      ?>
        <div class="row">
          <div class="col-md-6">
            <h2 class="mb-4">Liste des rôles</h2>
          </div>
          <div class="col-md-6 d-flex justify-content-end align-items-start">
            <a href="ajout.php" class="btn btn-outline-success"><i class="fas fa-plus"></i>&nbsp; Ajouter un rôle</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($liste as $role) {
                ?>
                  <tr>
                    <th scope="row"><?= $role['id'] ?></th>
                    <td><?= $role['nom'] ?></td>
                    <td>
                      <a href="voir.php?id=<?= $role['id'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i>&nbsp; Voir</a>
                      <a href="modif.php?id=<?= $role['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                      <a href="supp.php?id=<?= $role['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php
      } else {
      ?>
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
              <i class="fas fa-exclamation-triangle"></i>&nbsp; Aucun rôle n'existe dans la liste.
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LES DÉTAILS D'UN RÔLE
  public static function voirRole($id)
  {
    $modelRole = new ModelRole();
    $role = $modelRole->voirRole($id);
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Détails du rôle <?= $role['nom'] ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= $role['id'] . " - " . $role['nom']; ?> </h5>
              <p class="card-text"></p>
            </div>
            <ul class="list-group list-group-flush border-0 mb-2">
              <li class="list-group-item">
                <a href="liste.php" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
                <a href="modif.php?id=<?= $role['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp; Modifier</a>
                <a href="supp.php?id=<?= $role['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i>&nbsp; Supprimer</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE D'AJOUT D'UN RÔLE
  public static function ajoutRole()
  {
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Ajout d'un rôle</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col-md-6 offset-md-3">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>

            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux produits :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="produit" id="produitOui" value="oui">
                <label for="produitOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="produit" id="produitNon" value="non" checked>
                <label for="produitNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux catégories :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categorie" id="categorieOui" value="oui">
                <label for="categorieOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categorie" id="categorieNon" value="non" checked>
                <label for="categorieNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux marques :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="marque" id="marqueOui" value="oui">
                <label for="marqueOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="marque" id="marqueNon" value="non" checked>
                <label for="marqueNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux transporteurs :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transporteur" id="transporteurOui" value="oui">
                <label for="transporteurOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transporteur" id="transporteurNon" value="non" checked>
                <label for="transporteurNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux rôles :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="roleOui" value="oui">
                <label for="roleOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="roleNon" value="non" checked>
                <label for="roleNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux employés :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employe" id="employeOui" value="oui">
                <label for="employeOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employe" id="employeNon" value="non" checked>
                <label for="employeNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux commandes :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="commande" id="commandeOui" value="oui">
                <label for="commandeOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="commande" id="commandeNon" value="non" checked>
                <label for="commandeNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux clients :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="client" id="clientOui" value="oui">
                <label for="clientOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="client" id="clientNon" value="non" checked>
                <label for="clientNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux messages :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="message" id="messageOui" value="oui">
                <label for="messageOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="message" id="messageNon" value="non" checked>
                <label for="messageNon">non</label>
              </div>
            </div>

            <input type="submit" class="btn btn-primary" name="ajout" id="valider" value="Ajouter">
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  // FONCTION AFFICHANT LE FORMULAIRE DE MODIFICATION D'UN RÔLE
  public static function modifRole($id)
  {
    $modelRole = new ModelRole();
    $role = $modelRole->voirRole($id);
    $perm = json_decode($role['perm'], true); // Décodage du JSON contenant les permissions en tableau associatif PHP

  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Modification du rôle <?= $role['nom']; ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="modif.php" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <input type="hidden" name="id" class="form-control" id="id" value="<?= $role['id']; ?>">
            <div class="form-group">
              <label for="nom">Nom :</label>
              <input type="text" name="nom" id="nom" class="form-control" value="<?= $role['nom']; ?>" aria-describedby="nomHelp" data-type="nom" data-message="Le format du nom n'est pas correct">
              <small class="form-text text-muted" id="nomHelp"></small>
            </div>

            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux produits :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="produit" id="produitOui" value="oui" <?= $perm['Produits'] == "oui" ? "checked" : "" ?>>
                <label for="produitOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="produit" id="produitNon" value="non" <?= $perm['Produits'] == "non" ? "checked" : "" ?>>
                <label for="produitNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux catégories :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categorie" id="categorieOui" value="oui" <?= $perm['Catégories'] == "oui" ? "checked" : "" ?>>
                <label for="categorieOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="categorie" id="categorieNon" value="non" <?= $perm['Catégories'] == "non" ? "checked" : "" ?>>
                <label for="categorieNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux marques :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="marque" id="marqueOui" value="oui" <?= $perm['Marques'] == "oui" ? "checked" : "" ?>>
                <label for="marqueOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="marque" id="marqueNon" value="non" <?= $perm['Marques'] == "non" ? "checked" : "" ?>>
                <label for="marqueNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux transporteurs :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transporteur" id="transporteurOui" value="oui" <?= $perm['Transporteurs'] == "oui" ? "checked" : "" ?>>
                <label for="transporteurOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="transporteur" id="transporteurNon" value="non" <?= $perm['Transporteurs'] == "non" ? "checked" : "" ?>>
                <label for="transporteurNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux rôles :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="roleOui" value="oui" <?= $perm['Rôles'] == "oui" ? "checked" : "" ?>>
                <label for="roleOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="roleNon" value="non" <?= $perm['Rôles'] == "non" ? "checked" : "" ?>>
                <label for="roleNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux employés :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employe" id="employeOui" value="oui" <?= $perm['Employés'] == "oui" ? "checked" : "" ?>>
                <label for="employeOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="employe" id="employeNon" value="non" <?= $perm['Employés'] == "non" ? "checked" : "" ?>>
                <label for="employeNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux commandes :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="commande" id="commandeOui" value="oui" <?= $perm['Commandes'] == "oui" ? "checked" : "" ?>>
                <label for="commandeOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="commande" id="commandeNon" value="non" <?= $perm['Commandes'] == "non" ? "checked" : "" ?>>
                <label for="commandeNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux clients :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="client" id="clientOui" value="oui" <?= $perm['Clients'] == "oui" ? "checked" : "" ?>>
                <label for="clientOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="client" id="clientNon" value="non" <?= $perm['Clients'] == "non" ? "checked" : "" ?>>
                <label for="clientNon">non</label>
              </div>
            </div>
            <div class="form-group">
              <legend class="col-form-label">Peut accéder aux messages :</legend>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="message" id="messageOui" value="oui" <?= $perm['Messages'] == "oui" ? "checked" : "" ?>>
                <label for="messageOui">oui</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="message" id="messageNon" value="non" <?= $perm['Messages'] == "non" ? "checked" : "" ?>>
                <label for="messageNon">non</label>
              </div>
            </div>
            <input type="submit" class="btn btn-success" name="modif" id="valider" value="Modifier">
            <button type="reset" class="btn btn-danger">Réinitialiser</button>
          </form>
          <br />
          <a class="btn btn-primary" href="javascript:history.back()"><i class="fas fa-chevron-left"></i>&nbsp; Retour</a>
        </div>
      </div>
    </div>
<?php
  }
}
