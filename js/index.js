/**
 * Created by Ruslan on 15.08.2014.
 */
$(document).ready(function() {
//    $(".header_link").height($(".header_links_wrapper").height())
    control_size()
});

$(window).resize( function () {
    control_size();
    }
);

function control_size() {
    //h 126
    //w 150
    console.log($("body").width());
    if ($("body").width() <= 1280) {
       /***MAIN PAGE***/
        /*** HEADER ***/
        $(".header_menu").css({'font-size': $("body").width() * 0.0232});
        $(".header_link_logo_site_name").css({'font-size': $("body").width() * 0.0412});
        $(".header_link_logo_slogan").css({'font-size': $("body").width() * 0.016});
        $(".header").height($(".header").width()*0.1705);
        //$(".header_link_logo_img").css({'width': $(".header").height()*0.9, 'height': $(".header").height()*0.8});
        $(".header_no_link_phone").css({'background-size': "16% "+$(".header_no_link_phone").width()*0.2+"px"});
        $(".header_link_auth").css({'background-size': "22% "+$(".header_link_auth").width()*0.3+"px"});
        $(".header_link_cart").css({'background-size': "22% "+$(".header_link_cart").width()*0.3+"px"});
        $(".header_no_link_phone").css({'font-size': $(".header_no_link_phone").width()*0.13});
        $(".header_link_auth").css({'font-size': $(".header_link_auth").width()*0.115});
        $(".header_link_cart").css({'font-size': $(".header_link_cart").width()*0.13});
        /*** <--END HEADER--> ***/

        $(".container").height($(".carousel_container").height()*1.02);
        $(".box_container").height($(".carousel_container").height());
        $(".box_delivery").css({'font-size': $(".box_delivery").width()*0.18});
        $(".box_redial").css({'font-size': $(".box_redial").width()*0.105});
        $(".box_review").css({'font-size': $(".box_review").width()*0.115});

        if (window.location.pathname.indexOf("goods.html") + 1) {
            $(".goods_slider").height($(".carousel_container").height());
            $(".container").height($(".goods_slider").height());
        }
        setEqualHeight($(".good_title"));
       /*** END MAIN PAGE***/
    }
    else {
        $("body").css({"padding-left": (($("body").width()-1280)/2)});
        $("body").width(1280);
        control_size();
    }
}

function setEqualHeight(columns)
{
    var tallestcolumn = 0;
    columns.each(
        function()
        {
            currentHeight = $(this).height();
            if(currentHeight > tallestcolumn)
            {
                tallestcolumn = currentHeight;
            }
        }
    );
    columns.height(tallestcolumn);
}