<?php

class ViewTemplate
{
  public static function alert($type, $message, $lien = null)
  {
?>
    <div class="container alert alert-<?= $type ?>" role="alert">
      <?= $message ?> <br />
      <?php
      if ($lien) {  ?>
        Cliquez <a href="<?= $lien ?>" class="alert-link px-2">ici</a> pour continuer la navigation
      <?php
      }
      ?>
    </div>
  <?php
  }

  // HEADER D'UN VISITEUR CONNECTÉ
  public static function headerConnecte()
  {
  ?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-header mb-5">
        <div class="container">
          <a href="../produit/index.php" class="navbar-brand">E-commerce</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item"><a href="../produit/liste.php?page=1" class="nav-link">Liste des produits</a></li>
            </ul>
            <form class="form-inline align-center mx-auto my-lg-0">
              <input class="form-control mr-sm-2 recherche" type="search" placeholder="Chercher un produit" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
            </form>
            <ul class="navbar-nav ml-auto d-flex justify-content-end">
              <li class="nav-item"><a href="../panier/voirPanier.php" class="nav-link">Mon panier</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="compte" role="button" data-toggle="dropdown" aria-expanded="false">
                  Mon compte
                </a>
                <div class="dropdown-menu" aria-labelledby="compte">
                  <a class="dropdown-item" href="../client/accueil.php">Accueil Mon Espace</a>
                  <a class="dropdown-item" href="../client/voirClient.php">Mon profil</a>
                  <a class="dropdown-item" href="../commande/listeCommandeClient.php?page=1">Mes commandes</a>
                  <a class="dropdown-item btn-modif" href="../client/modifClient.php">Modifier mon profil</a>
                  <a class="dropdown-item btn-deco" href="../client/deconnexion.php">Déconnexion</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  <?php
  }

  // HEADER D'UN VISITEUR NON CONNECTÉ
  public static function headerInvite()
  {
  ?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-header mb-5">
        <div class="container">
          <a href="../produit/index.php" class="navbar-brand">E-commerce</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="../produit/liste.php?page=1" class="nav-link">Liste des produits</a></li>
            </ul>
            <form class="form-inline align-center mx-auto my-lg-0">
              <input class="form-control mr-sm-2 recherche" type="search" placeholder="Chercher un produit" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
            </form>
            <ul class="navbar-nav ml-auto d-flex justify-content-end">
              <li><a href="../client/inscription.php" class="btn btn-outline-primary">S'inscrire</a></li>
              <li>&nbsp;&nbsp;</li>
              <li><a href="../client/connexion-client.php" class="btn btn-outline-success btn-orng">Se connecter</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  <?php
  }

  public static function footer()
  {
  ?>
    <br />
    <footer class="footer bg-dark bg-footer mt-auto py-4 text-center h6">
      <div class="container">
        &copy; <?= date("Y") ?> - <a href="contact.php" class="no-style-footer">Contact</a> - <a href="" class="no-style-footer">Mentions légales</a> - <a href="" class="no-style-footer">Conditions générales de vente (CGV)</a> - <a href="connexion-admin.php" class="no-style-footer">Espace employé</a>
      </div>
    </footer>
<?php
  }
}
