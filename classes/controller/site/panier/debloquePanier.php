<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";
require_once "../panier/panier.php";

if (isset($_SESSION['panier'])) {
  deverrouillagePanier();
  header('Location: voirPanier.php');
}

