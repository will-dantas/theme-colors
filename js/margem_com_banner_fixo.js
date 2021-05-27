$(document).ready(function () {
    if ($(window).width() >= 767.98) {
        if ($('header.banner').hasClass('fixed-top')) {
            altura_barra_governo = $("#page").children('#barra_do_governo_brasil').height();
            altura_menu_header = $("#page").children('#header_menu').height();
            altura_banner = $("#page").children('header.banner').height();
            altura_header = altura_barra_governo + altura_menu_header + altura_banner;
            $('#page-content').css("cssText", "margin-top: " + parseInt(altura_header) + "px !important;");
        } else {
            $('#page-content').css("margin-top", 0);
        }
    } else {
        $('#page-content').css("margin-top", 0);
    }
});

$(window).resize(function () {
    if ($(window).width() >= 767.98) {
        if ($('header.banner').hasClass('fixed-top')) {
            altura_barra_governo = $("#page").children('#barra_do_governo_brasil').height();
            altura_menu_header = $("#page").children('#header_menu').height();
            altura_banner = $("#page").children('header.banner').height();
            altura_header = altura_barra_governo + altura_menu_header + altura_banner;
            $('#page-content').css("cssText", "margin-top: " + parseInt(altura_header) + "px !important;");
        } else {
            $('#page-content').css("margin-top", 0);
        }
    } else {
        $('#page-content').css("margin-top", 0);
    }
});