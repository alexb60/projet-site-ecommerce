<?php
class ViewTemplate
{
  public static function alert($type, $message, $lien = null)
  {
?>
    <div class="container alert alert-<?= $type ?>" role="alert">
      <?= $message ?> <br />
      <?php
      if ($lien) { ?>
        Cliquez <a href="<?= $lien ?>" class="alert-link px-2">ici</a> pour continuer la navigation
      <?php
      }
      ?>
    </div>
  <?php
  }
  public static function menu()
  {

  ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
      <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="categorie" role="button" data-toggle="dropdown" aria-expanded="false">
                Catégories
              </a>
              <div class="dropdown-menu" aria-labelledby="categorie">
                <a class="dropdown-item" href="../categorie/liste.php">Liste des catégories</a>
                <a class="dropdown-item" href="../categorie/ajout.php">Ajouter une catégorie</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="marque" role="button" data-toggle="dropdown" aria-expanded="false">
                Marques
              </a>
              <div class="dropdown-menu" aria-labelledby="marque">
                <a class="dropdown-item" href="../marque/liste.php">Liste des marques</a>
                <a class="dropdown-item" href="../marque/ajout.php">Ajouter une marque</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="marque" role="button" data-toggle="dropdown" aria-expanded="false">
                Transporteurs
              </a>
              <div class="dropdown-menu" aria-labelledby="marque">
                <a class="dropdown-item" href="../transporteur/liste.php">Liste des transporteurs</a>
                <a class="dropdown-item" href="../transporteur/ajout.php">Ajouter un transporteur</a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <?php

  }

  public static function footer()
  {
  ?>
    <div class="bg-dark py-4 mt-5 text-center text-light h3">
      <div class="container">
        copyright &copy; <?= date("Y") ?>
      </div>
    </div>
<?php
  }
}
