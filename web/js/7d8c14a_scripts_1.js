(function($) {
    "use strict";

    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 60
    });

    $('#topNav').affix({
        offset: {
            top: 200
        }
    });
    
    new WOW().init();
    
    $('a.page-scroll').bind('click', function(event) {
        var $ele = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($ele.attr('href')).offset().top - 60)
        }, 1450, 'easeInOutExpo');
        event.preventDefault();
    });
    
    $('.navbar-collapse ul li a').click(function() {
        /* always close responsive nav after click */
        $('.navbar-toggle:visible').click();
    });

    $('#galleryModal').on('show.bs.modal', function (e) {
       $('#galleryImage').attr("src",$(e.relatedTarget).data("src"));
    });

    $('#form-contact').bind('submit', function(event) {

        $.ajax({
            type: "POST",
            url: '',
            data: $("#form-contact").serialize(),
            success: function(data)
            {
                $('#alert-modal-contact').modal('show')
            }
        });
        event.preventDefault();
    });

    function resizeIframe()
    {
        if (obj.contentWindow.document.body)
        {
            var obj = $('#tryit iframe')[0];
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px'
        }
    }

    function hideAllTries()
    {
        var obj = $('#tryit #iframe-shop');
        obj[0].style = "display:none";

        obj = $('#tryit #iframe-payment-widget');
        obj[0].style = "display:none";
    }

    $('#tryit span.shop-iframe').click(function() {
        hideAllTries();
        var obj = $('#tryit #iframe-shop');
        obj.attr("src", obj.data("src"));
        obj[0].style = "";
    });

    $('#tryit span.payment-widget').click(function() {
        hideAllTries();
        var obj = $('#tryit #iframe-payment-widget');
        obj.attr("src", obj.data("src"));
        obj[0].style = "";
    });

    setInterval(function(){
        resizeIframe();
    }, 3000);

})(jQuery);