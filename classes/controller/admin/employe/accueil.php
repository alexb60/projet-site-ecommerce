<?php
session_start();

require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelCategorie.php";
require_once "../../../model/ModelMarque.php";
require_once "../../../model/ModelClient.php";
require_once "../../../model/ModelCommande.php";
require_once "../../../model/ModelTransporteur.php";

if (isset($_SESSION['id_employe'])) {
  $salutation = "Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . " et bienvenue sur l'espace employé";
  ViewTemplate::menu();
} else {
  header('Location: connexion-employe.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil espace employé</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>
  <?php
  $modelProduit = new ModelProduit();
  $nbProduits = $modelProduit->compteProduit();

  $modelCategorie = new ModelCategorie();
  $nbCategories = $modelCategorie->compteCategorie();

  $modelMarque = new ModelMarque();
  $nbMarques = $modelMarque->compteMarque();

  $modelClient = new ModelClient();
  $nbClients = $modelClient->compteClient();

  $modelTransporteur = new ModelTransporteur();
  $nbTransporteurs = $modelTransporteur->compteTransporteur();

  $modelCommande = new ModelCommande();
  $nbCommandes = $modelCommande->compteCommande();
  $chiffreAffaires = $modelCommande->chiffreAffaires();
  $moyMontant = $modelCommande->moyMontant();
  ?>
  <div class="container">
    <h2 class="mb-4"><?php echo $salutation; ?></h2>
    <div class="row">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Nombre de clients</h6>
            <p class="text-right nombres" id="#nbClients"><?= $nbClients['nb_clients'] ?></p>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Chiffre d'affaires</h6>
            <p class="text-right nombres" id="#chiffreAffaires"><?= $chiffreAffaires['chiffre'] ?> €</p>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Montant moyen d'une commande</h6>
            <p class="text-right nombres" id="#chiffreAffaires"><?= $moyMontant['moy_montant'] ?> €</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Nombre de commandes</h6>
            <p class="text-right nombres" id="#nbCommandes"><?= $nbCommandes['nb_commandes'] ?></p>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Nombre de produits</h6>
            <p class="text-right nombres" id="#nbProduit"><?= $nbProduits['nb_produits'] ?></p>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Nombre de catégories</h6>
            <p class="text-right nombres" id="#nbCategories"><?= $nbCategories['nb_categories'] ?></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Nombre de marques</h6>
            <p class="text-right nombres" id="#nbMarques"><?= $nbMarques['nb_marques'] ?></p>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Nombre de transporteurs</h6>
            <p class="text-right nombres" id="#nbMarques"><?= $nbTransporteurs['nb_transporteurs'] ?></p>
          </div>
        </div>
      </div>
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