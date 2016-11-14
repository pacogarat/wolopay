(function($) {
    /*"use strict";*/

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
        var ref = $ele.attr('href');
        ref = ref.substring(ref.indexOf("#"));

        var obj = $(ref);

        if (obj.length == 1)
        {
            $('html, body').stop().animate({
                scrollTop: (obj.offset().top - 60)
            }, 1450, 'easeInOutExpo');
        }

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

    function resizeIframeShop(width, height)
    {
        $('#iframe-shop').css('width', width);
        $('#iframe-shop').css('height', height);

        $('#iframe-shop-container .btn').removeClass('active');
    }

    $('#iframe-shop-container .mobile').click(function() {
        resizeIframeShop(375, 950);
        $('#iframe-shop-container .mobile').addClass('active');
    });
    $('#iframe-shop-container .tablet').click(function() {
        resizeIframeShop(800, 900);
        $('#iframe-shop-container .tablet').addClass('active');
    });
    $('#iframe-shop-container .laptop').click(function() {
        resizeIframeShop(1200, 1000);
        $('#iframe-shop-container .laptop').addClass('active');
    });

    $('#toggleVideo').click(function() {
        $('#main-text').fadeOut(0);
        $('#video').fadeIn("slow");
        var obj = $('#video iframe');
        obj.attr("src", obj.data("srcx"));

    });

    function hideAllTries()
    {
        var obj = $('#iframe-shop-container');
        obj[0].style = "display:none";
        obj[0].style.display = "none";
        document.getElementById("iframe-shop-container").style.display="none";

        obj = $('#tryit #iframe-payment-widget');
        obj[0].style = "display:none";
        obj[0].style.display = "none";
        document.getElementById("iframe-payment-widget").style.display="none";
    }

    $('#tryit span.shop-iframe').click(function() {
        hideAllTries();
        var obj = $('#iframe-shop-container');
        obj[0].style = "";
        document.getElementById("iframe-shop-container").style.display="";

        var obj = $('#tryit #iframe-shop');
        obj.attr("src", obj.data("srcx"));
        $('#iframe-shop-container')[0].style = "";
    });

    $('#tryit span.payment-widget').click(function() {
        hideAllTries();
        var obj = $('#tryit #iframe-payment-widget');
        obj.attr("src", obj.data("srcx"));
        obj[0].style = "";
        document.getElementById("iframe-payment-widget").style.display="";
    });

})(jQuery);