<?php

class ViewTemplate
{
  // FONCTION AFFICHANT UN MESSAGE APRÈS UNE ACTION
  public static function alert($type, $message, $lien = null)
  {
?>
    <div class="container alert alert-<?= $type ?>" role="alert">
      <i class="fas <?= ($type === "success") ? 'fa-check' : 'fa-times' ?>"></i>&nbsp; <?= $message ?><br />
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
            <form action="../produit/recherche.php" method="post" class="form-inline align-center mx-auto my-lg-0">
              <input class="form-control mr-sm-2 recherche" type="text" name="recherche" placeholder="Chercher un produit" aria-label="Search" id="recherche">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>&nbsp; Chercher</button>
            </form>
            <ul class="navbar-nav ml-auto d-flex justify-content-end">
              <li class="nav-item"><a href="../panier/voirPanier.php" class="nav-link"><i class="fas fa-shopping-cart"></i>&nbsp; Mon panier</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="compte" role="button" data-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-user-circle"></i>&nbsp; Mon compte
                </a>
                <div class="dropdown-menu" aria-labelledby="compte">
                  <a class="dropdown-item btn-home" href="../client/accueil.php"><i class="fas fa-home"></i>&nbsp; Accueil Mon Espace</a>
                  <a class="dropdown-item" href="../client/voirClient.php"><i class="fas fa-user-alt"></i>&nbsp; Mon profil</a>
                  <a class="dropdown-item btn-commandes" href="../commande/listeCommandeClient.php?page=1"><i class="fas fa-shopping-bag"></i>&nbsp; Mes commandes</a>
                  <a class="dropdown-item btn-modif" href="../client/modifClient.php"><i class="fas fa-edit"></i>&nbsp; Modifier mon profil</a>
                  <a class="dropdown-item" href="../message/contact.php"><i class="fas fa-envelope"></i>&nbsp; Contact</a>
                  <a class="dropdown-item btn-deco" href="../client/deconnexion.php"><i class="fas fa-sign-out-alt"></i>&nbsp; Déconnexion</a>
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
            <form action="../produit/recherche.php" method="post" class="form-inline align-center mx-auto my-lg-0">
              <input class="form-control mr-sm-2 recherche" type="text" placeholder="Chercher un produit" name="recherche" aria-label="Search" id="recherche">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i>&nbsp; Chercher</button>
            </form>
            <ul class="navbar-nav ml-auto d-flex justify-content-end">
              <li><a href="../client/inscription.php" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i>&nbsp; S'inscrire</a></li>
              <li>&nbsp;&nbsp;</li>
              <li><a href="../client/connexion-client.php" class="btn btn-outline-success btn-outline-orange"><i class="fas fa-sign-in-alt"></i>&nbsp; Se connecter</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  <?php
  }

  // FOOTER
  public static function footer()
  {
  ?>
    <br />
    <footer class="footer bg-dark bg-footer mt-auto py-4 text-center h6">
      <div class="container">
        &copy; <?= date("Y") ?> - <a href="../message/contact.php" class="no-style-footer">Contact</a> - <a href="mentions-legales.php" class="no-style-footer">Mentions légales</a> - <a href="cgv.php" class="no-style-footer">Conditions générales de vente (CGV)</a> - <a href="../../admin/employe/connexion-employe.php" class="no-style-footer">Espace employé</a>
      </div>
    </footer>
  <?php
  }

  // OUVERTURE DU HTML, HEAD ET OUVERTURE DE BODY
  public static function headHtml($titre)
  {
  ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?= $titre ?></title>
      <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
      <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
      <link rel="stylesheet" href="../../../../css/site.css">
    </head>

    <body class="d-flex flex-column min-vh-100">
    <?php
  }

  // SCRIPTS JS ET FERMETURE DU BODY ET DE HTML
  public static function bodyHtml($form = false)
  {
    ?>
      <script src="../../../../js/jquery.min.js"></script>
      <script src="../../../../js/bootstrap.bundle.min.js"></script>
      <script src="../../../../js/font-awesome.all.min.js"></script>
      <?php
      if ($form) {
      ?>
        <script src="../../../../js/validation-form.js"></script>
        <script src="../../../../js/main.js"></script>
      <?php
      }
      ?>
    </body>

    </html>
<?php
  }
}
