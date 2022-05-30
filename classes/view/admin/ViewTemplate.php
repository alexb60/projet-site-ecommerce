<?php
class ViewTemplate
{
  public static function alert($type, $message, $lien = null)
  {
?>
    <div class="container alert alert-<?= $type ?>" role="alert">
      <i class="fas <?= ($type === "success") ? 'fa-check' : 'fa-times' ?>"></i>&nbsp; <?= $message ?><br />
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
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-header mb-5">
        <a class="navbar-brand" href="../employe/accueil.php">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="produit" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-lightbulb"></i>&nbsp; Produits
              </a>
              <div class="dropdown-menu" aria-labelledby="produit">
                <a class="dropdown-item" href="../produit/liste.php?page=1"><i class="fas fa-list"></i>&nbsp; Liste des produits</a>
                <a class="dropdown-item" href="../produit/ajout.php"><i class="fas fa-plus"></i>&nbsp; Ajouter un produit</a>
              </div>
            </li>
            <li class="nav-item dropdown <?= $_SESSION['perm']['Catégories'] == "non" ? "d-none" : "" ?>">
              <a class="nav-link dropdown-toggle" href="#" id="categorie" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-tag"></i>&nbsp; Catégories
              </a>
              <div class="dropdown-menu" aria-labelledby="categorie">
                <a class="dropdown-item" href="../categorie/liste.php"><i class="fas fa-list"></i>&nbsp; Liste des catégories</a>
                <a class="dropdown-item" href="../categorie/ajout.php"><i class="fas fa-plus"></i>&nbsp; Ajouter une catégorie</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="marque" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="far fa-registered"></i>&nbsp; Marques
              </a>
              <div class="dropdown-menu" aria-labelledby="marque">
                <a class="dropdown-item" href="../marque/liste.php"><i class="fas fa-list"></i>&nbsp; Liste des marques</a>
                <a class="dropdown-item" href="../marque/ajout.php"><i class="fas fa-plus"></i>&nbsp; Ajouter une marque</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="transporteur" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-truck"></i>&nbsp; Transporteurs
              </a>
              <div class="dropdown-menu" aria-labelledby="transporteur">
                <a class="dropdown-item" href="../transporteur/liste.php"><i class="fas fa-list"></i>&nbsp; Liste des transporteurs</a>
                <a class="dropdown-item" href="../transporteur/ajout.php"><i class="fas fa-plus"></i>&nbsp; Ajouter un transporteur</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="role" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-theater-masks"></i>&nbsp; Rôles
              </a>
              <div class="dropdown-menu" aria-labelledby="role">
                <a class="dropdown-item" href="../role/liste.php"><i class="fas fa-list"></i>&nbsp; Liste des rôles</a>
                <a class="dropdown-item" href="../role/ajout.php"><i class="fas fa-plus"></i>&nbsp; Ajouter un rôle</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="role" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-shield"></i>&nbsp; Employés
              </a>
              <div class="dropdown-menu" aria-labelledby="role">
                <a class="dropdown-item" href="../employe/listeEmploye.php"><i class="fas fa-list"></i>&nbsp; Liste des employés</a>
                <a class="dropdown-item" href="../employe/ajoutEmploye.php"><i class="fas fa-plus"></i>&nbsp; Ajouter un employé</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../commande/listeCommande.php?page=1"><i class="fas fa-shopping-bag"></i>&nbsp; Commandes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../client/liste.php?page=1"><i class="fas fa-users"></i>&nbsp; Clients</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../message/liste.php?page=1"><i class="fas fa-envelope"></i>&nbsp; Messages</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="../../site/produit/index.php" class="btn btn-outline-light"><i class="fas fa-chevron-left"></i>&nbsp; Site client</a>
            </li>
            <li class="nav-item">&nbsp;</li>
            <li class="nav-item">
              <a href="../employe/modifEmploye.php" class="btn btn-outline-warning"><i class="fas fa-edit"></i>&nbsp; Profil</a>
            </li>
            <li class="nav-item">&nbsp;</li>
            <li class="nav-item">
              <a href="../employe/deconnexion.php" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i>&nbsp; Quitter</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
  <?php
  }

  public static function headerInvite()
  {
  ?>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-header mb-5">
        <div class="container">
          <a class="navbar-brand" href="#">Admin</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li><a href="../../site/produit/index.php" class="btn btn-outline-light"><i class="fas fa-chevron-left"></i>&nbsp; Retour sur le site client</a></li>
              <li>&nbsp;&nbsp;</li>
              <li><a href="../employe/connexion-employe.php" class="btn btn-outline-success btn-outline-orange"><i class="fas fa-sign-in-alt"></i>&nbsp; Se connecter</a></li>
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
        &copy; <?= date("Y") ?> - <a href="../../site/produit/index.php" class="no-style-footer">Site client</a>
      </div>
    </footer>
<?php
  }
}
