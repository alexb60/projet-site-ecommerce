<?php
session_start();

// Si le client est connecté...
if (isset($_SESSION['id'])) {
  session_destroy(); // Destruction de la session
  header('Location: connexion-client.php'); // Redirection vers la page de connexion à l'espace client
}
