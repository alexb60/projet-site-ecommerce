<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../view/site/ViewPanier.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "../../../model/ModelCommande.php";
require_once "../panier/panier.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Paiement");

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte(); // Header client connecté

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
    } else {
      ViewPanier::paiement(); // Afficher le formulaire de paiement
    }
  } else {
    ViewTemplate::alert("danger", "Aucune donnée disponible", "../panier/voirPanier.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html