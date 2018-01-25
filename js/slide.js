// JavaScript source code
$(document).ready(function () {
    var $carrousel = $('.diapo'),
    $img = $('.diapo .slideItem'),
    indexImg = $img.length - 1,
    i = 0,  // compteur
    $currentImg = $img.eq(i);

    $img.css('display', 'none');
    $currentImg.css('display', 'block');

    //debut de la fonction recursive pour le changement d'image
    function Slideimg() {
        setTimeout(function () {
            if (i < indexImg) {
                i++;
            }
            else {
                i = 0;
            }

            $img.fadeOut(1000);

            $currentImg = $img.eq(i);
            $currentImg.fadeIn(1000);
            Slideimg();
        }, 7000);
    }
    //fin de la fonction creee
    //appel de la fontion
    Slideimg();

});
