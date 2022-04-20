<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription</title>
  <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../../css/fontawesome.all.min.css">
  <link rel="stylesheet" href="../../../../css/admin.css">
  <style>
    .erreurInput {
      border: 2px solid red;
    }

    .erreurMessage {
      color: red;
    }
  </style>
</head>

<body>
  <?php
  require_once "../../../view/site/ViewClient.php";
  require_once "../../../model/ModelClient.php";

  if (isset($_POST['ajout'])) {
    var_dump($_POST);
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    var_dump($_POST);
    $user = new ModelClient();
    var_dump($_POST['nom']);
    if ($user->inscription($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $_POST['tel'])) {
  ?>
      <h1>Inscription faite avec succes </h1>
      <a href="connexion-user.php">Connexion</a>
    <?php
      var_dump($user->inscription($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $_POST['tel']));
    } else {
    ?>
      <h1> Echec de l 'inscription </h1>
      <a href="inscription.php"> Retour </a>
  <?php
      var_dump($user->inscription($_POST['nom'], $_POST['prenom'], $_POST['mail'], $pass, $_POST['adresse'], $_POST['ville'], $_POST['code_post'], $_POST['tel']));
    }
  } else {
    ViewClient::inscription();
  }
  ?>
  <script src="../../../../js/jquery.min.js"></script>
  <script src="../../../../js/bootstrap.bundle.min.js"></script>
  <script src="../../../../js/font-awesome.all.min.js"></script>
  <!-- <script>
    $(document).on("click", ".btn-primary", function(e) {
      e.preventDefault();
      let regexListe = {
        nom: /^[\p{L}\s]{2,}$/u,
        prenom: /^[\p{L}\s]{2,}$/u,
        mail: /^[a-zA-Z\d\.\_\-\p{L}]+@[a-zA-Z]+\.[a-z]{2,}$/,
        pass: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
        adresse: /^[\w\-\s]{5,}$/,
        code_post: /^((0[1-9])|([1-8]\d|9[0-578]))\d{3}$/,
        ville: /^[\p{L}\s\-]{1,}$/u,
        tel: /^[\d]{10,}$/,
      };

      $("small").text("");
      erreur = false;

      let formElements = $("form")[0];

      for (let i = 0; i < formElements.length - 2; i++) {
        if ($(formElements[i]).attr("type") === "password") {
          $("#pass").removeClass("erreurInput");
          $("#pass2").removeClass("erreurInput");

          const pattern = regexListe["pass"];

          if (pattern.test(formElements[i].value) === false) {
            erreur = true;
            $("#pass").addClass("erreurInput");
            $("#" + $(formElements[i]).attr("aria-describedby")).html(
              `<p class="erreurMessage">${$(formElements[i]).attr("data-message")}</p>`
            );
          }
        } else {
          $(formElements[i]).removeClass("erreurInput");
          $(formElements[i]).next().html("");

          const type = $(formElements[i]).attr("id");
          const pattern = regexListe[type];

          if (pattern.test(formElements[i].value) === false) {
            erreur = true;
            $(formElements[i]).addClass("erreurInput");
            $(formElements[i])
              .next()
              .html(`<p class="erreurMessage">${$(formElements[i]).attr("data-message")}</p>`);
          }
        }
      }
      if (!erreur) {
        $("form").submit();
      }
    });
  </script> -->
</body>

</html>