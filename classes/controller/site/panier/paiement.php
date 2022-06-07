<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/ViewPanier.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "../../../model/ModelCommande.php";
require_once "../panier/panier.php";

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
  session_destroy();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
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

<body class="d-flex flex-column min-vh-100">
  <?php
  // Si le panier et le mode d'envoi existent...
  if (isset($_SESSION['panier']) && isset($_SESSION['envoi'])) {

    // Si l'état existe dans POST...
    if (isset($_POST['etat'])) {

      $modelCommande = new ModelCommande();

      // Stockage du nombre de produits différents
      $nbProduits = count($_SESSION['panier']['id']);

      // La date et l'heure seront basés sur celles de Paris en France
      date_default_timezone_set('Europe/Paris');

      // Stockage du montant du panier
      $montantTotal = montantPanier();

      // Création de la commande et stockage de son id
      $dernierId = $modelCommande->creerCommande(date("Y-m-d H:i:s"), $_POST['etat'], $_SESSION['envoi']['mode'][0], $montantTotal, $_SESSION['id'], $_SESSION['envoi']['idTransporteur'][0]);

      // Pour chaque produit du panier...
      for ($i = 0; $i < $nbProduits; $i++) {
        // Ajout des détails du produit dans la table details_commande
        $modelCommande->ajoutDetailsCommande($dernierId, $_SESSION['panier']['id'][$i], $_SESSION['panier']['prix'][$i], $_SESSION['panier']['quantite'][$i]);

        // Mise à jour du stock du produit
        $modelCommande->majStock($_SESSION['panier']['id'][$i], $_SESSION['panier']['quantite'][$i]);
      }
      supprimerPanier(); // Vider le panier
      supprimerEnvoi(); // Supprimer le mode d'envoi

      // Afficher le succès
      ViewTemplate::alert("success", "Commande validée !<br />Merci pour votre achat !", "../commande/voirDetails.php?id_com=" . $dernierId);
    } else { // Sinon afficher le formulaire de paiement
      ViewPanier::paiement();
    }
  } else {
    ViewTemplate::alert("danger", "Aucune donnée disponible", "../panier/voirPanier.php");
  }
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>