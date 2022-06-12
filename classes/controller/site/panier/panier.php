<?php

// FONCTION DE CRÉATION DU PANIER
function creerPanier()
{
  $_SESSION['panier'] = array(); // Création du panier
  $_SESSION['panier']['id'] = array(); // Stockage de l'id du produit
  $_SESSION['panier']['quantite'] = array(); // Stockage de la quantité voulue
  $_SESSION['panier']['prix'] = array(); // Stockage du prix
  $_SESSION['panier']['verrou'] = false; // Verrou du panier, par défaut à false (déverrouillé)
}

// AJOUTER UN PRODUIT DANS LE PANIER
function ajoutPanier($id_produit, $quantiteProduit, $prix)
{
  $ajout = false; // Booléen confirmant l'ajout du produit au panier, par défaut à false (produit non ajouté)

  // Si le panier n'existe pas...
  if (!isset($_SESSION['panier'])) {
    creerPanier(); // Créer le panier
    array_push($_SESSION['panier']['id'], $id_produit); // Stocker l'id du produit dans le panier
    array_push($_SESSION['panier']['quantite'], $quantiteProduit); // Stocker le prix du produit dans le panier
    array_push($_SESSION['panier']['prix'], $prix); // Stocker la quantité du produit dans le panier
    $ajout = true; // Produit ajouté
  } elseif (!isset($_SESSION['panier']['verrou']) || !estVerrouille()) { // Sinon si le panier n'est pas verrouillé...

    // Si le produit n'est pas déjà présent dans le panier...
    if (!verifPanier($id_produit)) {
      array_push($_SESSION['panier']['id'], $id_produit); // Stocker l'id du produit dans le panier
      array_push($_SESSION['panier']['quantite'], $quantiteProduit); // Stocker la quantité du produit dans le panier
      array_push($_SESSION['panier']['prix'], $prix); // Stocker le prix du produit dans le panier
      $ajout = true; // Produit ajouté
    } else {
      // Sinon modifier la quantité du produit déjà présent
      $ajout = modifQuantite($id_produit, $quantiteProduit);
    }
  }
  return $ajout; // Retourner si le produit a été ajouté ou non
}

// MODIFIER LA QUANTITÉ D'UN PRODUIT DANS LE PANIER
function modifQuantite($id_produit, $quantite)
{
  $modifie = false; // Variable de retour confirmant la modification de la quantié du produit

  // Si le panier n'est pas verrouillé...
  if (!isset($_SESSION['panier']['verrou']) || !estVerrouille()) {

    // Si la quantité du produit existe et si elle est différente de celle envoyée...
    if (nombreProduit($id_produit) != false && $quantite != nombreProduit($id_produit)) {

      // ON COMPTE LE NOMBRE DE PRODUITS DIFFÉRENTS DANS LE TABLEAU
      $nbProduit = count($_SESSION['panier']['id']);

      // Parcours du tableau panier pour modifier le produit voulu
      for ($i = 0; $i < $nbProduit; $i++) {

        // Si l'id du produit que l'on souhaite modifier est égal à l'id du produit dans le tableau...
        if ($id_produit == $_SESSION['panier']['id'][$i]) {
          $_SESSION['panier']['quantite'][$i] = $quantite; // Quantité du produit = quantité donnée en paramètre
          $modifie = true; // Quantité modifiée
        }
      }
    } else {
      // Si l'article n'est pas présent dans le panier...
      if (nombreProduit($id_produit) != false) {
        $modifie = "absent";
      }
      // Si la quantité donnée est la même
      if ($quantite != nombreProduit($id_produit)) {
        $modifie = "quantite_ok";
      }
    }
  }
  return $modifie;
}

// SUPPRIMER UN PRODUIT DU PANIER
function supprimerProduit($id_produit)
{
  $suppression = false;
  if (!isset($_SESSION['panier']['verrou']) || !estVerrouille()) {

    $aCleSuppr = array_keys($_SESSION['panier']['id'], $id_produit);

    // Sortie la clé a été trouvée
    if (!empty($aCleSuppr)) {
      // On traverse le panier pour supprimer ce qui doit l'être
      foreach ($_SESSION['panier'] as $cle => $valeur) {
        foreach ($aCleSuppr as $valeur1) {
          unset($_SESSION['panier'][$cle][$valeur1]); // remplace la ligne problématique
        }
        // Réindexation des clés du panier
        $_SESSION['panier'][$cle] = array_values($_SESSION['panier'][$cle]);
        $suppression = true;
      }
    } else {
      $suppression = "absent";
    }
  }

  return $suppression;
}

// VÉRIFIER LA PRÉSENCE D'UN PRODUIT DANS LE PANIER
function verifPanier($id_produit)
{
  $present = false;
  if (count($_SESSION['panier']['id']) > 0 && array_search($id_produit, $_SESSION['panier']['id']) !== false) {
    $present = true;
  }
  return $present;
}

// VÉRIFIER LA QUANTITÉ ENREGISTRÉE D'UN PRODUIT DANS LE PANIER
function nombreProduit($id_produit)
{
  $nombre = false;
  $nbProduit = count($_SESSION['panier']['id']); // COMPTAGE DU PANIER

  // PARCOURS DU PANIER POUR VÉRIFIER LA QUANTITE DU PRODUIT ENREGISTRÉE DANS LE PANIER
  for ($i = 0; $i < $nbProduit; $i++) {
    if ($_SESSION['panier']['id'][$i] == $id_produit) {
      $nombre = $_SESSION['panier']['quantite'][$i];
    }
  }
  return $nombre;
}

// CALCULER LE MONTANT DU PANIER
function montantPanier()
{
  $montant = 0;
  $nbProduit = count($_SESSION['panier']['id']);
  for ($i = 0; $i < $nbProduit; $i++) {
    $montant += (int)$_SESSION['panier']['quantite'][$i] * (float)$_SESSION['panier']['prix'][$i]; // MONTANT = MONTANT PRÉCÉDANT + (QUANTITE * PRIX)
  }
  return $montant;
}

// CALCULER LE NOMBRE TOTAL DE PRODUITS COMMANDÉS
function quantiteTotale()
{
  $quantite = 0;
  $nbProduit = count($_SESSION['panier']['id']);
  for ($i = 0; $i < $nbProduit; $i++) {
    $quantite += $_SESSION['panier']['quantite'][$i];
  }
  return $quantite;
}

// VÉRIFIER SI LE PANIER EST VERROUILLÉ
function estVerrouille()
{
  if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou']) {
    return true;
  } else {
    return false;
  }
}

// VERROUILLER LE PANIER POUR LA PRÉPARATION DU PAIEMENT
function verrouPanier()
{
  $_SESSION['panier']['verrou'] = true;
}

// DÉVEROUILLER LE PANIER POUR LE RETOUR EN ARRIÈRE
function deverrouillagePanier()
{
  $_SESSION['panier']['verrou'] = false;
}

// SUPPRESSION DU PANIER
function supprimerPanier()
{
  unset($_SESSION['panier']);
}

// CREATION DU MODE D'ENVOI
function creerEnvoi()
{
  $_SESSION['envoi'] = array();
  $_SESSION['envoi']['mode'] = array();
  $_SESSION['envoi']['idTransporteur'] = array();
}

// AJOUT DU MODE D'ENVOI
function envoi($mode, $transporteur)
{
  $envoi = false;
  // SI ENVOI DÉJÀ EXISTANT...
  if (isset($_SESSION['envoi'])) {
    supprimerEnvoi();
    envoi($mode, $transporteur);
  } else {
    creerEnvoi();
    array_push($_SESSION['envoi']['mode'], $mode);
    array_push($_SESSION['envoi']['idTransporteur'], $transporteur);
    $envoi = true;
  }
  return $envoi;
}

// SUPPRESSION DU MODE D'ENVOI
function supprimerEnvoi()
{
  unset($_SESSION['envoi']);
}
