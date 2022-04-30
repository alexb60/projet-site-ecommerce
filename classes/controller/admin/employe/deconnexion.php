<?php
session_start();

if (isset($_SESSION['id_employe'])) {
  session_destroy();
  header('Location: connexion-employe.php');
}
