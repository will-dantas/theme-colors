$(document).ready(function() {

    // Declarando as variáveis [e pegando elas com base suas classes e id's]
    headerWrapper = parseInt($('#header-wrapper').height());
    offsetTolerance = 380;
    pointer = $('.pointer');
    firstNav = $('.navigation a:first').parent('li');
    defaultPointer = firstNav.offset().left;

    // Movendo o .pointer para o primeiro tópico do menu
    pointer.css('left', defaultPointer);
    firstNav.addClass('selected-nav2');

    // Detecta se o usuário está dando scroll
    $(window).scroll(function() {


        // Checa a posição do scroll
        scrollPosition = parseInt($(this).scrollTop());

        // Move através de cada menu e checa a posição do scroll para então mover o pointer.
        $('.navigation a').each(function() {

            thisHref = $(this).attr('href');
            thisTruePosition = parseInt($(thisHref).offset().top);
            thisPosition = thisTruePosition - headerWrapper - offsetTolerance;
            thisNav = $('.navigation a[href=' + thisHref + ']').parent('li');
            currentPosition = parseInt(thisNav.offset().left);

            if (scrollPosition >= thisPosition) {
                $('.selected-nav2').removeClass('selected-nav2');
                pointer.stop().animate({ 'left': currentPosition, 'width': $(thisNav).width() });
                thisNav.addClass('selected-nav2');
            }

        });

        // Se estiver no footer da página, move o .pointer para o último tópico
        bottomPage = parseInt($(document).height()) - parseInt($(window).height());
        lastNav = $('.navigation a:last').parent('li');
        currentPosition = lastNav.offset().left;

        if (scrollPosition == bottomPage || scrollPosition >= bottomPage) {

            $('.selected-nav2').removeClass('selected-nav2');
            pointer.stop().animate({ 'left': currentPosition, 'width': $(thisNav).width() });
            lastNav.addClass('selected-nav2');
        }
    });
});