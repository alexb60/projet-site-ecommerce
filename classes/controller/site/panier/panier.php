<?php

function creerPanier()
{
  $_SESSION['panier'] = array();
  $_SESSION['panier']['id'] = array();
  $_SESSION['panier']['quantite'] = array();
  $_SESSION['panier']['prix'] = array();
  $_SESSION['panier']['verrou'] = false;
}

// AJOUTE UN PRODUIT DANS LE PANIER
function ajoutPanier($id_produit, $quantiteProduit, $prix)
{
  $ajout = false;
  if (!isset($_SESSION['panier'])) {
    creerPanier();
    array_push($_SESSION['panier']['id'], $id_produit);
    array_push($_SESSION['panier']['quantite'], $quantiteProduit);
    array_push($_SESSION['panier']['prix'], $prix);
    $ajout = true;
  } elseif (!isset($_SESSION['panier']['verrou']) || !estVerrouille()) {
    if (!verifPanier($id_produit)) {
      array_push($_SESSION['panier']['id'], $id_produit);
      array_push($_SESSION['panier']['quantite'], $quantiteProduit);
      array_push($_SESSION['panier']['prix'], $prix);
      $ajout = true;
    } else {
      $ajout = modifQuantite($id_produit, $quantiteProduit);
    }
  }
  return $ajout;
}

// MODIFIE LA QUANTITÉ D'UN PRODUIT DANS LE PANIER
function modifQuantite($id_produit, $quantite)
{
  $modifie = false;
  if (!isset($_SESSION['panier']['verrou']) || !estVerrouille()) {
    if (nombreProduit($id_produit) != false && $quantite != nombreProduit($id_produit)) {

      // ON COMPTE LE NOMBRE DE PRODUITS DIFFÉRENTS DANS LE TABLEAU
      $nbProduit = count($_SESSION['panier']['id']);

      // ON PARCOURT LE TABLEAU POUR MODIFIER LE PRODUIT VOULU
      for ($i = 0; $i < $nbProduit; $i++) {
        if ($id_produit == $_SESSION['panier']['id'][$i]) {
          $_SESSION['panier']['quantite'][$i] = $quantite;
          $modifie = true;
        }
      }
    } else {
      if (nombreProduit($id_produit) != false) {
        $modifie = "absent";
      }
      if ($quantite != nombreProduit($id_produit)) {
        $modifie = "quantite_ok";
      }
    }
  }
  return $modifie;
}

// SUPPRIME UN PRODUIT DU PANIER
function supprimerProduit($id_produit)
{
  $suppression = false;
  if (!isset($_SESSION['panier']['verrou']) || !estVerrouille()) {

    $aCleSuppr = array_keys($_SESSION['panier']['id'], $id_produit);

    /* sortie la clé a été trouvée */
    if (!empty($aCleSuppr)) {
      /* on traverse le panier pour supprimer ce qui doit l'être */
      foreach ($_SESSION['panier'] as $k => $v) {
        foreach ($aCleSuppr as $v1) {
          unset($_SESSION['panier'][$k][$v1]);    // remplace la ligne foireuse
        }
        // Réindexation des clés du panier
        $_SESSION['panier'][$k] = array_values($_SESSION['panier'][$k]);
        $suppression = true;
      }
    } else {
      $suppression = "absent";
    }
  }

  return $suppression;
}

// VÉRIFIE LA PRÉSENCE D'UN PRODUIT DANS LE PANIER
function verifPanier($id_produit)
{
  $present = false;
  if (count($_SESSION['panier']['id']) > 0 && array_search($id_produit, $_SESSION['panier']['id']) !== false) {
    $present = true;
  }
  return $present;
}

// VÉRIFIE LA QUANTITÉ ENREGISTRÉE D'UN PRODUIT DANS LE PANIER
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

// CALCULE LE MONTANT DU PANIER
function montantPanier()
{
  $montant = 0;
  $nbProduit = count($_SESSION['panier']['id']);
  for ($i = 0; $i < $nbProduit; $i++) {
    $montant += (int)$_SESSION['panier']['quantite'][$i] * (float)$_SESSION['panier']['prix'][$i]; // MONTANT = MONTANT PRÉCÉDANT + (QUANTITE * PRIX)
  }
  return $montant;
}

// CALCULE LE NOMBRE TOTAL DE PRODUITS COMMANDÉS
function quantiteProduitPanier()
{
  $quantite = 0;
  $nbProduit = count($_SESSION['panier']['id']);
  for ($i = 0; $i < $nbProduit; $i++) {
    $quantite += $_SESSION['panier']['quantite'][$i];
  }
  return $quantite;
}

// VÉRIFIE SI LE PANIER EST VERROUILLÉ
function estVerrouille()
{
  if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou']) {
    return true;
  } else {
    return false;
  }
}

// VERROUILLAGE DU PANIER POUR LA PRÉPARATION DU PAIEMENT
function verrouPanier()
{
  $_SESSION['panier']['verrou'] = true;
}

// DÉVEROUILLAGE DU PANIER POUR LE RETOUR EN ARRIÈRE
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
