/**
 * Created by eric92350 on 21/12/2015.
 */
(function($) {
    if (!$.exist) {
        $.extend({
            exist: function(elm) {
                if (typeof elm == null) return false;
                if (typeof elm != "object") elm = $(elm);
                return elm.length ? true : false;
            }
        });
        $.fn.extend({
            exist: function() {
                return $.exist($(this));
            }
        });
    }
})(jQuery);

$(document).ready(function(){
    $(window).scroll(function() {
        t = $('.content').offset();
        t = t.top;

        s = $(window).scrollTop();

        d = t-s;

        if (d < 0) {
            $('#navbar').addClass('fixed');
        } else {
            $('#navbar').removeClass('fixed');
        }
    });
});

function toggleLoading(msg){
    if(typeof(msg) === 'undefined')
        msg = '';

    if($('#loading_box').exist())
        $('#loading_box').remove();
    else
        $('body').append('<div id="loading_box"><div>'+msg+'</div></div>');
}