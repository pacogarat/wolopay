
shopApp.factory('sliders', function ( $timeout) {

    var seconds=300;

    var sliderProducts = new Slider($('.products'), $(".section-custom"));
    var sliderPayMethods = new Slider($('.pay-methods'), $(".section-custom"));

    function reset(slider)
    {
        $timeout(function(){slider.resize();}, 50);
    }

    $(window).resize(function() {
        reset(sliderProducts);
        reset(sliderPayMethods);
    });

    return {

        resetProductSlider: function() {
            reset(sliderProducts);
        },
        resetPayMethodSlider: function () {
            reset(sliderPayMethods);
        },
        restartPosition: function(){
            sliderProducts.restartPosition();
            sliderPayMethods.restartPosition();
        },
        restartPayMethodsPosition: function(){
            sliderPayMethods.restartPosition();
        }
    };

});