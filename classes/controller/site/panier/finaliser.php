<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "../panier/panier.php";

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
  session_destroy();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}

if (isset($_SESSION['panier'])) {
  verrouPanier();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalisation de la commande</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/site.css">
</head>

<body>

  <?php
  /*

  FORMULAIRE DE CHOIX DU MODE D'ENVOI ET DU TRANSPORTEUR
  STOCKER LE RÉSULTAT DANS LA SESSION CAR CRÉATION DE COMMANDE SE FAIT APRÈS PAIEMENT
  -> CRÉER UNE VARIABLE $_SESSION['modeEnvoi'] QUI CONTIENT 2 TABLEAUX ASSOCIATIFS :
          - $_SESSION['modeEnvoi']['mode']            -> STOCKE LE MODE D'ENVOI
          - $_SESSION['modeEnvoi']['idTransporteur']  -> STOCKE LE TRANSPORTEUR (À CONFIRMER)
  VALEURS À PASSER DANS LA TABLE COMMANDE PAR LA SUITE

  RENVOI VERS PAGE DE PAIEMENT -> PAGE DE PAIEMENT CLOS LE PROCESSUS DE COMMANDE CÔTÉ CLIENT ET
  ENREGISTRE LE PANIER DANS LES TABLES COMMANDES ET DETAILS_COMMANDE

  BOUTON RETOUR QUI DÉBLOQUE LE PANIER POUR CONTINUER LES ACHATS EN CAS D'OUBLI

  */
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>