<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelClient.php";
require_once "../../../model/ModelCommande.php";

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  $modelClient = new ModelClient();
  $prenom = $modelClient->voirClient($_SESSION['id'])['prenom']; // Stockage du prénom du client
  $nom = $modelClient->voirClient($_SESSION['id'])['nom']; // Stockage du nom du client
  $salutation = "Bonjour " . $prenom . " " . $nom; // Création du message de salutation
  ViewTemplate::headerConnecte(); // Header client connecté
} else {
  header('Location: connexion-client.php'); // Redirection vers la page de connexion client
}

// head HTML et ouverture de body
ViewTemplate::headHtml("Accueil espace client");

$modelCommande = new ModelCommande();
$nbCommandes = $modelCommande->compteCommandeClient($_SESSION['id']); // Stockage du nombre de commandes passées par le client
$depense = $modelCommande->depenseClient($_SESSION['id']); // Stockage du montant total dépensé par le client
$moyMontantClient = $modelCommande->moyMontantClient($_SESSION['id']); // Stockage du montant moyen d'une commande du client
?>
<div class="container">
  <h1 class="mb-4"><?= $salutation ?></h1>
  <div class="row">
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted">Nombre de commandes passées</h6>
          <p class="text-right nombres" id="#nbCommandes"><?= $nbCommandes['nb_commandes'] ?></p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted">Total dépensé</h6>
          <p class="text-right nombres" id="#depenseTotale"><?= ($depense['depense'] == NULL) ? 0 : $depense['depense'] ?> €</p>
        </div>
      </div>
    </div>
    <div class="col mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="card-subtitle text-muted">Montant moyen d'une commande</h6>
          <p class="text-right nombres" id="#chiffreAffaires"><?= ($moyMontantClient['moy_montant_client'] == NULL) ? 0 : $moyMontantClient['moy_montant_client'] ?> €</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html