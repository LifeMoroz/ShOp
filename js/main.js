/**
 * Created by Ruslan on 18.09.2014.
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
    setEqualHeight($(".good_title"));
    if ($("body").width() <= 1280) {
        $(".container").height($(".carousel_container").height() * 1.02);
        $(".box_container").height($(".carousel_container").height());
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
        if ($(".body").width() < 850) {
            $(".modal-content").width(720)
        }
        /*** <--END BODY--> ***/
        /*** END MAIN PAGE***/
    }
    else {
        control_size()
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