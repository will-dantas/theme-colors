$(document).ready(function () {
    if ($(window).width() >= 767.98) {
        altura_barra_governo = $("#page").children('#barra_do_governo_brasil').height();
        altura_menu_header = $("#page").children('#header_menu').height();
        altura_banner = $("#page").children('header.banner').height();
        altura_header = altura_barra_governo + altura_menu_header + altura_banner;
        $('.menu-scroll').children('span#pointer_menu').css("margin-top", parseInt(altura_header) - 20);
        $('.menu-scroll').children('ul#navegation_horizontal_menu').css("margin-top", parseInt(altura_header) - 20);
        $('.bg-alternado#info').css("margin-top", parseInt(altura_header) + 30);
        $('#page-wrapper').children('.missao-sobre').css("margin-top", parseInt(altura_header) + 30);
    } else {
        $('.menu-scroll').children('span#pointer_menu').css("margin-top", 0);
        $('.menu-scroll').children('ul#navegation_horizontal_menu').css("margin-top", 0);
        $('.bg-alternado#info').css("margin-top", 0);
        $('#page-wrapper').children('.missao-sobre').css("margin-top", 0);
    }
});

$(window).resize(function () {
    if ($(window).width() >= 767.98) {
        altura_barra_governo = $("#page").children('#barra_do_governo_brasil').height();
        altura_menu_header = $("#page").children('#header_menu').height();
        altura_banner = $("#page").children('header.banner').height();
        altura_header = altura_barra_governo + altura_menu_header + altura_banner;
        $('.menu-scroll').children('span#pointer_menu').css("margin-top", parseInt(altura_header) - 20);
        $('.menu-scroll').children('ul#navegation_horizontal_menu').css("margin-top", parseInt(altura_header) - 20);
        $('.bg-alternado#info').css("margin-top", parseInt(altura_header) + 30);
        $('#page-wrapper').children('.missao-sobre').css("margin-top", parseInt(altura_header) + 30);
    } else {
        $('.menu-scroll').children('span#pointer_menu').css("margin-top", 0);
        $('.menu-scroll').children('ul#navegation_horizontal_menu').css("margin-top", 0);
        $('.bg-alternado#info').css("margin-top", 0);
        $('#page-wrapper').children('.missao-sobre').css("margin-top", 0);
    }
});