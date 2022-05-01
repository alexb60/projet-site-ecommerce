<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelCommande.php";

if (isset($_SESSION['id'])) {
  $salutation = "Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'];
  ViewTemplate::headerConnecte();
} else {
  header('Location: connexion-client.php');
  exit;
}
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>
  <?php
  $modelCommande = new ModelCommande();
  $nbCommandes = $modelCommande->compteCommandeClient($_SESSION['id']);
  $depense = $modelCommande->depenseClient($_SESSION['id']);
  $moyMontantClient = $modelCommande->moyMontantClient($_SESSION['id']);
  ?>
  <div class="container">
    <h1 class="mb-4"><?php echo $salutation; ?></h1>
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
            <p class="text-right nombres" id="#depenseTotale"><?= $depense['depense'] ?> €</p>
          </div>
        </div>
      </div>
      <div class="col mb-4">
        <div class="card">
          <div class="card-body">
            <h6 class="card-subtitle text-muted">Montant moyen d'une commande</h6>
            <p class="text-right nombres" id="#chiffreAffaires"><?= $moyMontantClient['moy_montant_client'] ?> €</p>
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