// RETOUR SUR LA PAGE PRÉCÉDANTE DEPUIS LA PAGE DE RETOUR DE COMMANDE
$(document).on("click", "#nonRetour", function (e) {
  e.preventDefault(); // Bloquer le comportement par défaut de l'événement

  window.location.href = "listeCommandeClient.php?page=1"; // Redirection
});
