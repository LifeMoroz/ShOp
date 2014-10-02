/**
 * Created by Ruslan on 29.09.2014.
 */
$(document).ready(function() {
    /*** HEADER ***/
    $(".header_menu").css({'font-size': $("body").width() * 0.0232});
    $(".header_link_logo_site_name").css({'font-size': $("body").width() * 0.0412});
    $(".header_link_logo_slogan").css({'font-size': $("body").width() * 0.016});
    $(".header").height($(".header").width() * 0.1705);
    $(".header_no_link_phone").css({'background-size': "16% " + $(".header_no_link_phone").width() * 0.2 + "px"});
    $(".header_link_auth").css({'background-size': "22% " + $(".header_link_auth").width() * 0.3 + "px"});
    $(".header_link_cart").css({'background-size': "22% " + $(".header_link_cart").width() * 0.3 + "px"});
    $(".header_no_link_phone").css({'font-size': $(".header_no_link_phone").width() * 0.13});
    $(".header_link_auth").css({'font-size': $(".header_link_auth").width() * 0.115});
    $(".header_link_cart").css({'font-size': $(".header_link_cart").width() * 0.13});
    /*** <--END HEADER--> ***/
    if ($("body").width() >= 1260 && $("body").width() < 1280 || $("body").width() > 1280) {
        $("body").css({"padding-left": (($("body").width() - 1280) / 2)});
        $("body").width(1260);
    }
});
