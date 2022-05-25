$(document).on("click", "#valider", function (e) {
  e.preventDefault();

  // LISTE DES REGEX
  let regexListe = {
    nom: /^[\p{L}\s\-]{1,}$/u,
    prenom: /^[\p{L}\s\-]{2,}$/u,
    mail: /^[a-zA-Z\d\.\_\-\p{L}]+@[a-zA-Z]+\.[a-z]{2,}$/,
    pass: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/,
    adresse: /^[\w\-\s]{5,}$/,
    code_post: /^((0[1-9])|([1-8]\d|9[0-578]))\d{3}$/,
    ville: /^[\p{L}\s\-]{1,}$/u,
    tel: /^[\d]{10,}$/,
    prix: /^\d{1,}(\.\d{2}){0,1}$/,
    ref: /^[a-zA-Z0-9]{1,}$/,
    quantite: /^\d{1,}$/,
    description: /^[\p{L}\s\-\d]{1,}$/u,
  };

  // SUPPRESSION DU TEXTE CONTENU DANS TOUS LES ÉLÉMENTS SMALL
  $("small").text("");

  // erreur, booléen, si vrai signifie qu'il y a des champs non conformes
  erreur = false;

  let formElements = $("form")[1];

  // formElements.length - 2 : pour ne pas récupérer les boutons submit et reset
  for (let i = 0; i < formElements.length - 2; i++) {
    if ($(formElements[i]).attr("type") === "hidden") {
      // TRAITEMENT DES CHAMPS DE TYPE HIDDEN

      continue; // Continuer la boucle
    } else if ($(formElements[i]).attr("type") === "radio") {
      // TRAITEMENT DES BOUTONS RADIOS

      $("#" + $(formElements[i]).attr("aria-describedby")).html("");
      if ($("input[name='" + $(formElements[i]).attr("name") + "']:checked").length === 0) {
        erreur = true;
        $("#" + $(formElements[i]).attr("aria-describedby")).html(
          `<p class="erreurMessage">${$(formElements[i]).attr("data-message")}</p>`
        );
      }
    } else if ($(formElements[i]).attr("type") === "password") {
      // TRAITEMENT DU CHAMP PASSWORD

      $("#pass").removeClass("erreurInput");
      $("#pass2").removeClass("erreurInput");

      const pattern = regexListe["pass"];

      // Si le mot de pass n'est pas conforme au pattern...
      if (pattern.test(formElements[i].value) === false) {
        erreur = true;
        $("#pass").addClass("erreurInput");
        $("#pass2").addClass("erreurInput");
        $("#" + $(formElements[i]).attr("aria-describedby")).html(
          `<p class="erreurMessage">${$(formElements[i]).attr("data-message")}</p>`
        );
      }

      // Si la valeur du champ "mot de passe" et celle du champ "confirmer le mot de passe" ne sont pas identiques...
      if ($("#pass").val() !== $("#pass2").val()) {
        erreur = true;
        $("#pass").addClass("erreurInput");
        $("#pass2").addClass("erreurInput");
        $("#pass2Help").html(`<p class="erreurMessage">Les deux mots de passe doivent être identiques</p>`);
      }
    } else if ($(formElements[i]).prop("tagName").toLowerCase() === "select") {
      // TRAITEMENT DU SELECT

      $(formElements[i]).removeClass("erreurInput");
      //$(formElements[i]).next().html("");

      // Si la valeur de l'option choisie est nulle...
      if (formElements[i].value === "") {
        erreur = true;
        $(formElements[i]).addClass("erreurInput");
        $("#" + $(formElements[i]).attr("aria-describedby")).html(
          `<p class="erreurMessage">${$(formElements[i]).attr("data-message")}</p>`
        );
      }
    } else {
      // TRAITEMENT DES AUTRES INPUTS

      $(formElements[i]).removeClass("erreurInput");
      $(formElements[i]).next().html("");

      const type = $(formElements[i]).attr("id"); // Stockage de la valeur de l'attribut type de l'input dans la variable type
      const pattern = regexListe[type]; // pattern prend la regex correspondant au type donné

      // Si la valeur du champ ne correspond pas au pattern...
      if (pattern.test(formElements[i].value) === false) {
        erreur = true;
        $(formElements[i]).addClass("erreurInput");
        $(formElements[i])
          .next()
          .html(`<p class="erreurMessage">${$(formElements[i]).attr("data-message")}</p>`);
      }
    }
  }
  // S'il n'y a aucune erreur...
  if (!erreur) {
    $("form")[1].submit(); // Envoyer le formulaire
  }
});
