/**
 * Created by Yacine on 24/02/2017.
 */
$('.wrapper-container .login-popup .fa-stack').on('click', function () {
    $(".wrapper-container").hide();
});
$('.se-connecter').on('click', function () {
    $(".wrapper-container").show();
});
/**
 * Afficher la page Se connecter
 */
$('.wrapper-container .login-popup .sign-up a').on('click', function () {

    $('.sign-up').slideUp(400, function () {
        $('.sign-in').slideDown();
    });
})
/**
 * Afficher la page Creer
 */
$('.wrapper-container .login-popup .sign-in a').on('click', function () {


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
