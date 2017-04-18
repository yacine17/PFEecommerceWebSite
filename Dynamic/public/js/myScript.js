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
            $this.parent().parent().fadeOut();
            var count = parseInt($(".fa-heart .number-elements").text());
            $(".fa-heart .number-elements").text(--count);
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
                $this.parent().parent().fadeOut();
                var count = parseInt($(".fa-shopping-cart .number-elements").text());
                $(".fa-shopping-cart .number-elements").text(--count);
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