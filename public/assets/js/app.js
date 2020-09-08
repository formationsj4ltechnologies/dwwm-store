$(document).ready(function () {

    // Preloader
    $('.preloader')
        .delay(2000)
        .fadeOut('slow');

    setTimeout(function () {
        // Après 2s, la classe sans défilement du corps sera supprimée
        $('body').removeClass('no-scroll');
    }, 2000); // Ici, vous pouvez modifier le temps du préchargement

    //Contenu panier
    $(".js-contenu-panier").mouseenter(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/panier/",
            method: "GET"
        }).done(function (datas) {
            $("#contenu-panier").empty();
            const imagePath = 'assets/img/produits'
            datas.forEach(function (ligne) {
                    $("#contenu-panier").append(
                        `<div></div>`
                    );
                }
            );
        });
    });
})