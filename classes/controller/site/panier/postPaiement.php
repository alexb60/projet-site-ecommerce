<?php
session_start();
require_once "../../../view/site/ViewTemplate.php";

if (isset($_SESSION['id'])) {
  ViewTemplate::headerConnecte();
} else {
  ViewTemplate::headerInvite();
  session_destroy();
  ViewTemplate::alert("danger", "Vous devez être connecté pour accéder à cette page", "../client/connexion-client.php");
}
ViewTemplate::alert("success", "Commande validée !<br />Merci pour votre achat !", "../client/accueil.php");
ViewTemplate::footer();

?>
