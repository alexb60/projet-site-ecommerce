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
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
          <a href="#" class="navbar-brand">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item"><a href="../produit/liste.php?page=1" class="nav-link">Liste des produits</a></li>
            </ul>
            <ul class="navbar-nav ml-auto d-flex justify-content-end">
              <li class="nav-item"><a href="../produit/voirPanier.php" class="nav-link">Mon panier</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="produit" role="button" data-toggle="dropdown" aria-expanded="false">
                  Mon compte
                </a>
                <div class="dropdown-menu" aria-labelledby="produit">
                  <a class="dropdown-item" href="../client/accueil.php">Accueil Mon Espace</a>
                  <a class="dropdown-item" href="../client/voirClient.php">Mon profil</a>
                  <a class="dropdown-item btn-modif" href="../client/modifClient.php">Modifier mon profil</a>
                  <a class="dropdown-item btn-deco" href="../client/deconnexion.php">Déconnexion</a>
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
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
          <a href="#" class="navbar-brand">Navbar</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item"><a href="../produit/liste.php?page=1" class="nav-link">Liste des produits</a></li>
            </ul>
            <ul class="navbar-nav ml-auto d-flex justify-content-end">
              <li><a href="../client/inscription.php" class="btn btn-outline-primary">S'inscrire</a></li>
              <li>&nbsp;&nbsp;</li>
              <li><a href="../client/connexion-client.php" class="btn btn-outline-success">Se connecter</a></li>
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
    <footer class="footer bg-dark mt-auto py-3 text-center text-light h4">
      <div class="container">
        copyright &copy; <?= date("Y") ?>
      </div>
    </footer>
<?php
  }
}
