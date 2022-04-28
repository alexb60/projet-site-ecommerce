<?php
session_start();

require_once "../../../view/site/ViewTemplate.php";
require_once "panier.php";

if (isset($_SESSION['panier'])) {
  supprimerProduit($_GET['id']);
  header('Location: voirPanier.php');
}
