//Confirm Button pour suppression
$(".confirm").click(function () {
    return confirm('Êtes vous sûr de vouloir supprimer ?');
});

//Rechercher un produit à la page produits
function rechercherProduit(nom) {
    var ligne = $(".gestionProduit table > tbody > tr");
    ligne.each(function () {
       var ligne = $(this);
       nom = nom.toLowerCase();
       var ref = ligne.children("td:first-child").text().toLowerCase();
       var libelle = ligne.children("td:nth-child(3)").text().toLowerCase();
       var prix = ligne.children("td:nth-child(5)").text().toLowerCase();
       if ((ref.indexOf(nom) == -1) && (libelle.indexOf(nom) == -1) && (prix.indexOf(nom) != 0) )
           ligne.addClass("hidden");
       else
           ligne.removeClass("hidden");
    })
}

//Rechercher une facture à la page factures
function rechercherFacture(nom) {
    var ligne = $(".gestionFacture table > tbody > tr");
    ligne.each(function () {
        var ligne = $(this);
        nom = nom.toLowerCase();
        var numFacture = ligne.children("td:first-child").text();
        var client = ligne.children("td:nth-child(2)").text().toLowerCase();
        if ((numFacture.indexOf(nom) != 0) && (client.indexOf(nom) == -1))
            ligne.addClass("hidden");
        else
            ligne.removeClass("hidden");
    })
}

function rechercherCommande(nom) {
    var ligne = $(".gestionCommande table > tbody > tr");
    ligne.each(function () {
        var ligne = $(this);
        nom = nom.toLowerCase();
        var numCommande = ligne.children("td:first-child").text();
        var client = ligne.children("td:nth-child(2)").text().toLowerCase();
        var etat = ligne.children("td:nth-child(4)").text().toLowerCase();
        if ((numCommande.indexOf(nom) != 0) && (client.indexOf(nom) == -1) && (etat.indexOf(nom) == -1))
            ligne.addClass("hidden");
        else
            ligne.removeClass("hidden");
    })
}

//Invoquer la fonction rechercherProduit lors d'une saisie a la barre de recherche produit
$("#rechercherProduit").on('input', function () {
    var nom = this.value;
    rechercherProduit(nom);
});
//Invoquer la fonction rechercherFacture lors d'une saisie a la barre de recherche facture
$("#rechercherFacture").on('input',function () {
    var nom = this.value;
    rechercherFacture(nom);
});
$("#rechercherCommande").on('input', function () {
    var nom = this.value;
    rechercherCommande(nom);
});
