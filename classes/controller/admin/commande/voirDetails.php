<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de la commande</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
</head>

<body>

  <?php
  require_once "../../../view/admin/ViewCommande.php";
  require_once "../../../view/admin/ViewTemplate.php";
  require_once "../../../model/ModelClient.php";
  require_once "../../../model/ModelCommande.php";
  require_once "../../../model/ModelTransporteur.php";

  $modelCommande = new ModelCommande();
  $commande = $modelCommande->voirCommande($_GET['id_com']);

  ViewTemplate::menu();
  ViewCommande::voirDetails($_GET['id_com']);
  ViewTemplate::footer();
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
</body>

</html>