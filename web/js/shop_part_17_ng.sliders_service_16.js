
shopApp.factory('sliders', function ( $timeout, $rootScope) {

    var seconds=300;

    var sliderProducts = new Slider($('.products'), $(".section-custom"), $rootScope.productsRows);
    var sliderPayMethods = new Slider($('.pay-methods'), $(".section-custom"), $rootScope.payMethodsRows);

    function reset(slider)
    {
        $timeout(function(){slider.resize();}, 50);
    }

    $(window).resize(function() {
        reset(sliderProducts);
        reset(sliderPayMethods);
    });

    return {
        forceMaxWidthProductsBox: function(){
            $('.products .inner-wrapper').css("width", 5000);
        },
        forceMaxWidthPayMethodsBox: function(){
            $('.pay-methods .inner-wrapper').width("width", 5000);
        },
        resetProductSlider: function() {
            sliderProducts = new Slider($('.products'), $(".section-custom"), $rootScope.productsRows);
        },
        resetPayMethodSlider: function () {
            sliderPayMethods = new Slider($('.pay-methods'), $(".section-custom"), $rootScope.payMethodsRows);
        },
        restartPosition: function(){
            sliderProducts.restartPosition();
            sliderPayMethods.restartPosition();
        },
        restartPayMethodsPosition: function(){
            sliderPayMethods.restartPosition();
        },
        goToProductN: function(num){
            $timeout(function() { sliderProducts.goToNumImage(num); }, 500);
        },
        goToPayMethodN: function(num){
            $timeout(function() { sliderPayMethods.goToNumImage(num); }, 500);
        }
    };

});