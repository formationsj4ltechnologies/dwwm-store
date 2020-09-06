$(document).ready(function () {

    // Preloader
    $('.preloader')
        .delay(2000)
        .fadeOut('slow');

    setTimeout(function () {
        // Après 2s, la classe sans défilement du corps sera supprimée
        $('body').removeClass('no-scroll');
    }, 2000); // Ici, vous pouvez modifier le temps du préchargement

})