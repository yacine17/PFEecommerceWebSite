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

function rechercherEmploye(nom) {
    var ligne = $(".gestionCompte table > tbody > tr");
    ligne.each(function () {
        var ligne = $(this);
        nom = nom.toLowerCase();
        var numEmp = ligne.children("td:first-child").text().toLowerCase();
        var nomEmp = ligne.children("td:nth-child(2)").text().toLowerCase();
        var prenomEmp = ligne.children("td:nth-child(3)").text().toLowerCase();
        var email = ligne.children("td:nth-child(4)").text().toLowerCase();
        if ((numEmp.indexOf(nom) != 0) && (nomEmp.indexOf(nom) == -1) && (prenomEmp.indexOf(nom) == -1) && (email.indexOf(nom) == -1))
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
})
$("#rechercherCommande").on('input', function () {
    var nom = this.value;
    rechercherCommande(nom);
});
$("#rechercherEmploye").on('input', function () {
    var nom = this.value;
    rechercherEmploye(nom);
});
/**
 * Ajouter un ligne de caracterisitque à ajouter produit
 */
$(".ajouterCaracteristique").on('click', function () {
    ajouterLigneCaracteristique();
});
function ajouterLigneCaracteristique() {
    var childs = $(".caracteristique").children("div");
    var nbrCara = childs.length;
    var htmlCara = "<div class='col-sm-10 col-sm-offset-2'><div class='col-sm-5'>" +  "" +
        "<label for='carnom1' class='col-sm-5 control-label'></label> <div class='col-sm-7'>" +
        "<input type='text' class='form-control' id='carnom" + nbrCara + "' name='carnom" + nbrCara +
        "' placeholder='Nom' required> <span class='requiredInput'>*</span>" +
    "</div></div> <div class='col-sm-7'><label for='cardesc1' class='col-sm-2 control-label'></label>" +
    "<div class='col-sm-9'><input type='text' class='form-control' id='cardesc" + nbrCara + "' name='cardesc" + nbrCara +
        "' placeholder='Valeur' required> <span class='requiredInput'>*</span>" +
    "</div> <div class='col-sm-1'><i class='fa fa-close fa-2x supprimerCaracterestique'></i> </div> </div> </div>";
    childs.last().before(htmlCara);
}

/**
 * Afficher les produits commandés à la page gestion commandes
 */
$('#detailCommande').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var etat = button.data('etat');
    var url = 'pages/back/produitsCommande.php?id=' + id + '&etat=' + etat;
    var modal = $(this);
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
});

$('#factureModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var url = 'pages/back/detailFacture.php?id=' + id;
    var modal = $(this);
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
});
$(document).ready(function()
    {
        $("#tableDesCommandes").tablesorter();
        $("#tableDesFactures").tablesorter();
        $("#tableDesProduit").tablesorter();
        $("#tableDesEmploye").tablesorter();
        $("#commandeFournisseurTable").tablesorter();
        $("input[required]").after("<span class='requiredInput'>*</span>");
    }
);

$(document).on('click', ".supprimerCaracterestique", function () {
    $(this).parent().parent().parent().fadeOut().remove();
});

$('#detailEmployeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var url = 'pages/back/detailEmploye.php?id=' + id;
    var modal = $(this);
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
});

$('.gestionProduit table tbody tr td:last-child').on('click', function (e) {
    e.stopPropagation();
    var $menu = $(this).find('.menu');
    var $fa = $(this).find(".fa-ellipsis-v");
    if ($fa.hasClass("menuEpinle"))
        $fa.removeClass("menuEpinle");
    else
        $fa.addClass("menuEpinle");
    $('.gestionProduit table tbody tr td:last-child .menu').not($menu).each(function () {
        $(this).slideUp();
    });
    $('.gestionProduit .fa-ellipsis-v').not($fa).each(function () {
        $(this).removeClass("menuEpinle");
    });
    $menu.slideToggle();

});
$('body').on('click', function () {
    $('.gestionProduit table tbody tr td:last-child .menu').slideUp();
    $(this).find(".fa-ellipsis-v").removeClass("menuEpinle");
});

$(".commander").on('click', function () {
    var button = $(this) // Button that triggered the modal
    var id = button.data('id');
    console.log(button.text());
    var url = 'pages/back/commanderProduit.php?id=' + id;
    var modal = $("#CommanderModal");
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
    $("#CommanderModal").modal({
        show: true
    })
});

$('#CommandeFournisseurModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var url = 'pages/back/commandeFournisseur.php?id=' + id;
    var modal = $(this);
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
});