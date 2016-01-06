<script src="foundation/js/vendor/jquery.js"></script>
<script src="foundation/js/foundation.min.js"></script>
<script>
    $(document).ready(function(){
        $(window).scroll(function() {
            t = $('#content').offset();
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
</script>