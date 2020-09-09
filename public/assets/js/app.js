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
            const imagePath = 'assets/img/produits'
            $("#contenu-panier").empty();
            datas.forEach(function (ligne) {
                $("#contenu-panier").append(
                    `<tr>`
                    + `<td>`
                    + `<img src="${imagePath}/${ligne.produit.imageName}" alt="" width="80"></td>`
                    + `<td class="panier-nom-produit">${ligne.produit.nom}</td>`
                    + `<td class="panier-prix-produit">${ligne.produit.prix} € </td>`

                    + '</tr>'
                );
            })
        });
    });
})