<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/ViewPanier.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "../../../model/ModelCommande.php";
require_once "../panier/panier.php";

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
  session_destroy();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}

if (isset($_SESSION['panier']) && isset($_SESSION['envoi'])) {
  ViewPanier::paiement();
  if (isset($_POST['etat'])) {

    $modelCommande = new ModelCommande();

    $nbProduits = count($_SESSION['panier']['id']); // STOCKAGE DU NOMBRE DE PRODUITS DIFFÉRENTS
    date_default_timezone_set('Europe/Paris'); // LA DATE ET L'HEURE SERONT BASÉ CELLE DE PARIS EN FRANCE
    $montantTotal = montantPanier();

    $dernierId = $modelCommande->creerCommande(date("Y-m-d H:i:s"), $_POST['etat'], $_SESSION['envoi']['mode'][0], $montantTotal, $_SESSION['id'], $_SESSION['envoi']['idTransporteur'][0]);
    for ($i = 0; $i < $nbProduits; $i++) {
      $modelCommande->ajoutDetailsCommande($dernierId, $_SESSION['panier']['id'][$i], $_SESSION['panier']['prix'][$i], $_SESSION['panier']['quantite'][$i]);
      $modelCommande->majStock($_SESSION['panier']['id'][$i], $_SESSION['panier']['quantite'][$i]);
    }
    supprimerPanier();
    supprimerEnvoi();
    header('Location: postPaiement.php');
  }
} else {
  ViewTemplate::alert("danger", "Aucune donnée disponible", "../panier/voirPanier.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paiement</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>
<div class="container">

</div>
<?php
ViewTemplate::footer();
?>

<body>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script src="../../../../js/validation-form.js"></script> -->
</body>

</html>