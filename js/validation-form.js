$(document).on("click", "#valider", function (e) {
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
