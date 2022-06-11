<?php
session_start();

// Si l'id de l'employé existe dans la session...
if (isset($_SESSION['id_employe'])) {
  session_destroy(); // Destruction de la session
  header('Location: connexion-employe.php'); // Redirection vers la page de connexion à l'espace employé
}
