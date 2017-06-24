/**
 * Created by Yacine on 24/02/2017.
 */
/**
 * Afficher la page Se connecter
 */
$('.login .sign-up a').on('click', function () {

    $('.sign-up').slideUp(400, function () {
        $('.sign-in').slideDown();
    });
})
/**
 * Afficher la page Creer
 */
$('.login .sign-in a').on('click', function () {


    $('.sign-in').slideUp(400, function () {
        $('.sign-up').slideDown();
    });
})
/**
 * Afficher le mot de passe lorsque l'utilisateur passe le pointeur sur l'oeil
 */
$('.show-pass').hover(function () {
    $(this).parent().children().first().attr('type', 'text');
    },function () {
    $(this).parent().children().first().attr('type', 'password');
})
/**
 * Afficher le bouton qui redirige l'utilisateur vers la barre de recherche
 * et afficher l'ombre du navbar
 */
$(window).scroll(function () {
    var search = $("#goToSearch");
    $(this).scrollTop() >= 60 ? search.show() : search.hide();
    $(this).scrollTop() >= 40 ? $(".navbar").css('box-shadow', '2px 1px 10px #999') : $(".navbar").css('box-shadow', 'none');
    $(this).scrollTop() >= 40 ? $(".navbar .container .row").fadeOut() : $(".navbar .container .row").fadeIn();
})
/**
 * Rediriger l' utilisateur vers la barre de recherche en cliquant sur le bouton en bas a droite
 */
$("#goToSearch").on('click', function () {

    $("html,body").animate({scrollTop : 0}, 600)
    $("#searchBar").focus();
});

/**
 * Ajouter un produit au favori
 */
$(".detail-produit .cara-produit .add-to-favorite").on('click', function () {
    if ($(this).find(".fa").hasClass("added-to-favorite"))
        $(this).find(".fa").removeClass("added-to-favorite");
    else
        $(this).find(".fa").addClass("added-to-favorite");
});

/**
 * Ajouter un produit au panier
 */
$(".cart-add").on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var url = $this.attr('href');
    $.ajax(url)
        .done(function () {
            var count = parseInt($(".fa-shopping-cart .number-elements").text());
            $(".fa-shopping-cart .number-elements").text(++count);

        })
        .fail(function () {

        }).always(function () {

        });
});

/**
 * Ajouter un produit au favoris
 */
$(".favori-add").on('click', function (e) {
    e.preventDefault();
    var $this = $(this);
    var url = $this.attr('href');
    $.ajax(url)
        .done(function () {
            var count = parseInt($(".fa-heart .number-elements").text());
            $(".fa-heart .number-elements").text(++count);
        }).fail(function () {

        }).always(function () {

    });
});

/**
 * Enlver un produit de la liste des favoris
 */
$(".supprimerFavori").on('click', function (e) {
    e.preventDefault();
    if (confirm("Etes vous sur de vouloir supprimer cet article de votre lite des favoris?"))
    var $this = $(this);
    var url = $this.attr('href');
    $.ajax(url)
        .done(function () {
            $this.parent().parent().fadeOut().remove();
            var count = parseInt($(".fa-heart .number-elements").text());
            $(".fa-heart .number-elements").text(--count);
            if ($("table tr").length == 1)
            {
                var panierVide = "<div class='alert alert-danger'>Votre liste des favoris est vide</div>";
                $(".tab").replaceWith(panierVide);
            }
        }).fail(function () {
        $this.find(".fa").addClass("added-to-favorite");
        }).always(function () {

    });
});

/**
 * Supprimer un article du panier
 */
$(".retirer-produit").on('click', function (e) {
    e.preventDefault();
    if (confirm("Etes vous sur de vouloir supprimer cet article de votre panier?"))
    {
        var $this = $(this);
        var url = $this.attr('href');
        $.ajax(url)
            .done(function () {
                $this.parent().parent().fadeOut().remove();
                var count = parseInt($(".fa-shopping-cart .number-elements").text());
                $(".fa-shopping-cart .number-elements").text(--count);
                if ($("table tr").length == 1)
                {
                    var panierVide = "<div class='alert alert-danger'>Votre panier est vide</div>";
                    $(".detailPanier").replaceWith(panierVide);
                }
            }).fail(function () {

        }).always(function () {

        });
    }
});

/**
 * Supprimer tt les produits du panier
 */
$(".retirerToutProduit").on('click', function (e) {
    e.preventDefault();
    if (confirm("Etes vous sur de vouloir supprimer tout les article de votre panier?"))
    {
        var $this = $(this);
        var url = $this.attr('href');
        $.ajax(url)
            .done(function () {
                $('.table').fadeOut(600, function () {
                    var panierVide = "<div class='alert alert-danger'>Votre panier est vide</div>";
                    $('.contenu-panier .container').html(panierVide);
                });
                $(".fa-shopping-cart .number-elements").text(0);
            }).fail(function () {

        }).always(function () {

        });
    }
});

$(document).on('input', ".quantiteProduit", function () {
    var thisInput = $(this);
    var qte = thisInput.val();
    if (qte >= 1)
    {
        var ligneCourante = thisInput.parent().parent();
        var prixUnitaire = ligneCourante.find(".prixUnitaire");
        var montant = ligneCourante.find(".montant");
        montant.text(parseInt(prixUnitaire.text()) * parseInt(qte));
        var montants = $(".montant");
        var prixTotalHT = 0;
        montants.each(function () {
            prixTotalHT += parseInt($(this).text());
        });
        $(".prixTotalHorsTaxe").text(prixTotalHT);
        $(".prixTTC").text(prixTotalHT);
        var id = ligneCourante.data("idproduit");
        var url = "../pages/gestionPanier.php?do=changerQuantite&id=" + id + "&qte=" + qte;
        $.ajax(url)
            .done(function (data) {
            })
    }
});

$('#detailProduitModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var url = '../pages/templates/detailProduit.php?id=' + id;
    var modal = $(this);
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
});
$('#detailCommandeModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var url = '../pages/templates/detailCommande.php?id=' + id;
    var modal = $(this);
    $.ajax(url)
        .done(function (data) {
            modal.html(data);
        });
});

$("#ajouterArticle").keyup(function () {
    var nomArticle = $(this).val();
    $.post('../pages/recherchePanier.php', {search: nomArticle}, function (data) {
        var listeDeRecherche = $(".resultatRecherche ul");
        $(".resultatRecherche ul li").remove();
            if (data)
                $(".resultatRecherche").show();
        listeDeRecherche.html(data);
        if (!data)
            $(".resultatRecherche").hide();
    });
});

$(document).on('click', ".contenu-panier .resultatRecherche .ajouterPanier", function () {
    var id = $(this).data('id');
    var url = '../pages/gestionPanier.php?id=' + id + '&r=returnProduit';
    console.log(url);
    $.ajax(url)
        .done(function (produit) {
            var count = parseInt($(".fa-shopping-cart .number-elements").text());
            $(".fa-shopping-cart .number-elements").text(++count);
            $(".contenu-panier table tbody").append(produit);
            $(".contenu-panier table tbody tr:last-child").fadeIn(1000);
        });
});

$("#seConnecter").submit(function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    var submitButton = $(this).find("button[type='submit']");
    submitButton.html("Se connecter " + "<i class='fa fa-spinner fa-pulse fa-fw'></i>");
    $.ajax({
        type: "POST",
        url: url,
        data: data
    }).done(function () {
        location.reload();
    }).fail(function () {
        var alertErreur = "<div class='alert alert-danger col-md-6 col-md-offset-3'>" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span></button>" +
            "Nom d'utilisateur ou mot de passe erroné</div>";
        $("#loginModal form").before(alertErreur);
    }).always(function () {
        submitButton.html("Se connecter");
    })
})
$("#sInscrire").submit(function (e) {
    e.preventDefault();
    var data = $(this).serialize();
    var url = $(this).attr('action');
    var submitButton = $(this).find("button[type='submit']");
    submitButton.html("S'inscrire " + "<i class='fa fa-spinner fa-pulse fa-fw'></i>");
    $.ajax({
        type: "POST",
        url: url,
        data: data
    }).done(function () {
        location.reload();
    }).fail(function (jqXHR, msg) {
        console.log(jqXHR);
        var alertErreur = "<div class='alert alert-danger col-md-6 col-md-offset-3'>" +
            "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>" +
            "<span aria-hidden='true'>&times;</span></button>" +
            msg + "</div>";
        $("#loginModal form").before(alertErreur);
    }).always(function () {
        submitButton.html("S'inscrire");
    })
})