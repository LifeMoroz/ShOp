/**
 * Created by Ruslan on 15.08.2014.
 */
$(document).ready(function() {
//    $(".header_link").height($(".header_links_wrapper").height())
    control_size();

    $(".good  .green_button").click(function(e) {
        console.log($(this).data('id'));
        $.ajax({
            type: "POST",
            url: "/",
            data: {
                goodId: $(this).data('id')
            }
        });
    });

});

    $(window).resize( function () {
        control_size();
    }
);

function control_size() {
    console.log($("body").width());
    if ($("body").width() <= 1280) {
        $(".item > img").width(($(".header").width() - $(".menu_wrapper").width())*0.87);
        $(".goods_slider").height($(".carousel_container").height());
        $(".container").height($(".goods_slider").height());
        if ($("body").width() < 1000) {
            $(".goods_container > div.good:nth-child(5)").css({display: 'none'})
        }
        else if ($("body").width() < 1250) {
            $(".goods_container > div.good:nth-child(5)").css({display: 'none'});
            $(".goods_container > div.good:nth-child(4)").css({display: 'none'})
        } else {
            $(".goods_container > div.good:nth-child(5)").css({display: 'inline-block'});
            $(".goods_container > div.good:nth-child(4)").css({display: 'inline-block'})
        }
    } else {
        $("body").width(1280)
    }
}
