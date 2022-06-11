<?php
session_start();

require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelEmploye.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelCategorie.php";
require_once "../../../model/ModelMarque.php";
require_once "../../../model/ModelClient.php";
require_once "../../../model/ModelCommande.php";
require_once "../../../model/ModelTransporteur.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Accueil espace employé");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  $modelEmploye = new ModelEmploye();
  $prenom = $modelEmploye->voirEmploye($_SESSION['id_employe'])['prenom']; // Stochage du prénom de l'employé
  $nom = $modelEmploye->voirEmploye($_SESSION['id_employe'])['nom']; // Stockage du nom de l'employé

  $salutation = "Bonjour " . $prenom . " " . $nom . " et bienvenue sur l'espace employé"; // Création du message de salutation
  ViewTemplate::menu(); // Header admin connecté
} else {
  header('Location: connexion-employe.php'); // Redirection vers la page de connexion
}

$modelProduit = new ModelProduit();
$nbProduits = $modelProduit->compteProduit(); // Stockage du nombre total de produits

$modelCategorie = new ModelCategorie();
$nbCategories = $modelCategorie->compteCategorie(); // Stockage du nombre total de catégories

$modelMarque = new ModelMarque();
$nbMarques = $modelMarque->compteMarque(); // Stockage du nombre total de marques

$modelClient = new ModelClient();
$nbClients = $modelClient->compteClient(); // Stockage du nombre total de clients

$modelTransporteur = new ModelTransporteur();
$nbTransporteurs = $modelTransporteur->compteTransporteur(); // Stockage du nombre total de transporteurs

$modelCommande = new ModelCommande();
$nbCommandes = $modelCommande->compteCommande(); // Stockage du nombre total de commandes
$chiffreAffaires = $modelCommande->chiffreAffaires(); // Stockage du chiffre d'affaires
$moyMontant = $modelCommande->moyMontant(); // Stockage du montant moyen d'une commande
?>
<div class="container">
  <h2 class="mb-4"><?= $salutation ?></h2>
  <!-- Affichage des statistiques -->
  <div class="row">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-user"></i>&nbsp; Nombre de clients</h6>
          <p class="text-right nombres" id="#nbClients"><?= $nbClients['nb_clients'] ?></p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-box"></i>&nbsp; Nombre de commandes</h6>
          <p class="text-right nombres" id="#nbCommandes"><?= $nbCommandes['nb_commandes'] ?></p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-lightbulb"></i>&nbsp; Nombre de produits</h6>
          <p class="text-right nombres" id="#nbProduit"><?= $nbProduits['nb_produits'] ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-euro-sign"></i>&nbsp; Chiffre d'affaires</h6>
          <p class="text-right nombres" id="#chiffreAffaires"><?= number_format($chiffreAffaires['chiffre'], 2, ',', ' ') ?> €</p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-euro-sign"></i>&nbsp; Montant moyen d'une commande</h6>
          <p class="text-right nombres" id="#chiffreAffaires"><?= number_format($moyMontant['moy_montant'], 2, ',', ' ') ?> €</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="far fa-registered"></i>&nbsp; Nombre de marques</h6>
          <p class="text-right nombres" id="#nbMarques"><?= $nbMarques['nb_marques'] ?></p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-tag"></i>&nbsp; Nombre de catégories</h6>
          <p class="text-right nombres" id="#nbCategories"><?= $nbCategories['nb_categories'] ?></p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted"><i class="fas fa-truck"></i>&nbsp; Nombre de transporteurs</h6>
          <p class="text-right nombres" id="#nbMarques"><?= $nbTransporteurs['nb_transporteurs'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html