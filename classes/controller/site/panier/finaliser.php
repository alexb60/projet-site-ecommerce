<?php
session_start();
require_once "../../../view/site/ViewProduit.php";
require_once "../../../view/site/ViewTemplate.php";
require_once "../../../model/ModelProduit.php";
require_once "../../../model/ModelTransporteur.php";
require_once "panier.php";

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

  if (isset($_SESSION['id']) && estVerrouille()) {
    $modelTransporteur = new ModelTransporteur();
    $listeTransporteur = $modelTransporteur->listeTransporteur();
  ?>
    <div class="container">
      <div class="row mb-4">
        <div class="col-md-12">
          <h2>Finalisation de la commande</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">
            <div class="form-group">
              <label for="mode">Mode de livraison :</label>
              <select name="mode" id="mode" class="form-control" aria-describedby="modeHelp" data-type="modeSelect" data-message="Veuillez choisir un mode de livraison.">
                <option selected disabled value="">Choisissez un mode de livraison</option>
                <option value="domicile">Livraison à votre domicile</option>
                <option value="bureau de poste">Livraison au bureau de poste</option>
                <option value="relais">Livraison en point relais</option>
              </select>
              <small id="modeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="transporteur">Transporteur :</label>
              <select name="transporteur" id="transporteur" class="form-control" aria-describedby="transporteurHelp" data-type="transporteurSelect" data-message="Veuillez choisir un transporteur.">
                <option selected disabled value="">Choisissez un transporteur</option>
                <?php
                foreach ($listeTransporteur as $transporteur) {
                ?>
                  <option value="<?= $transporteur['id'] ?>"><?= $transporteur['nom'] ?></option>
                <?php
                }
                ?>
              </select>
              <small id="transporteurHelp" class="form-text text-muted"></small>
            </div>
            <input type="submit" id="valider" class="btn btn-success">
            <input type="reset" class="btn btn-danger">
          </form>
          <a href="debloquePanier.php" class="btn btn-primary">← Retour au panier</a>
        </div>
      </div>
    </div>
  <?php
  }
  if (isset($_POST['mode'])) {
    if (envoi($_POST['mode'], $_POST['transporteur'])) {
      header('Location: paiement.php');
    } else {
      ViewTemplate::alert("danger", "Erreur d'envoi des donées", "finaliser.php");
    }
  }
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
  <script src="../../../../js/validation-form.js"></script>
</body>