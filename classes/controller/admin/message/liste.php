<?php
session_start();

require_once "../../../view/admin/ViewMessage.php";
require_once "../../../view/admin/ViewTemplate.php";
require_once "../../../model/ModelMessage.php";

// head HTML et ouverture de body
ViewTemplate::headHtml("Détails d'une marque");

// Si l'employé est connecté...
if (isset($_SESSION['id_employe'])) {
  ViewTemplate::menu(); // Header admin connecté

  // Si le rôle permet d'accéder à cette section...
  if ($_SESSION['perm']['Messages'] == "oui") {

    // PAGINATION
    // Si la page est passé en GET et que le paramètre n'est pas vide...
    if (isset($_GET['page']) && !empty($_GET['page'])) {
      $pageActuelle = (int) strip_tags($_GET['page']); // La page actuelle est égale au paramètre page passé par GET transformé de string à int
    } else {
      $pageActuelle = 1; // Sinon la page actuelle est la page 1
    }

    $modelMessage = new ModelMessage();
    $nbMessages = (int) $modelMessage->compteMessage()['nb_messages_client']; // STOCKAGE DU NOMBRE DE MESSAGES PASSÉ EN INT DANS $nbMessages
    $parPage = 15; // NOMBRE DE MESSAGES PAR PAGE VOULU

    $pages = ceil($nbMessages / $parPage); // CALCUL DU NOMBRE DE PAGE NÉCESSAIRE ARRONDI À L'ENTIER SUPÉRIEUR (fonction ceil)
    $premier = ($pageActuelle * $parPage) - $parPage; // CALCUL DU 1ER MESSAGE DE LA PAGE
?>
    <div class="container">
      <?php
      ViewMessage::listeMessageClient($premier, $parPage); // Afficher la liste des messages
      ?>
      <nav>
        <ul class="pagination justify-content-center">
          <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
          <li class="page-item <?= ($pageActuelle == 1) ? "disabled" : "" ?>">
            <a href="liste.php?page=<?= $pageActuelle - 1 ?>" class="page-link">Précédent</a>
          </li>
          <?php
          // Pour chaque page allant de 1 au nombre total de pages - 1 en incrémentant de 1
          for ($page = 1; $page <= $pages; $page++) {
          ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($pageActuelle == $page) ? "active" : "" ?>">
              <a href="liste.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
            </li>
          <?php
          }
          ?>
          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
          <li class="page-item <?= ($pageActuelle == $pages) ? "disabled" : "" ?>">
            <a href="liste.php?page=<?= $pageActuelle + 1 ?>" class="page-link">Suivant</a>
          </li>
        </ul>
      </nav>
    </div>
<?php
  } else {
    ViewTemplate::alert("danger", "Accès interdit, vous n'avez pas la permission pour accéder à cette page", "../employe/accueil.php"); // Message d'erreur
  }
} else {
  ViewTemplate::headerInvite(); // Header invité
  ViewTemplate::alert("danger", "Accès interdit", "../employe/connexion-employe.php"); // Message d'erreur
}
ViewTemplate::footer(); // Footer

ViewTemplate::bodyHtml(); // Scripts JS et fermeture du body et de html