angular.module('shopApp').factory('sliders', ['$timeout', '$rootScope', function ( $timeout, $rootScope) {

    var sliderProducts, sliderPayMethods ;

    function waitForElement(){

        if($('.products .arrow-right').length > 0){
            sliderProducts = new Slider('.products', ".section-custom", $rootScope.productsRows, true);
            sliderPayMethods = new Slider('.pay-methods', ".section-custom", $rootScope.payMethodsRows, true);
        }
        else{
            setTimeout(function(){
                waitForElement();
            },250);
        }
    }

    waitForElement();

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
//            $('.products .inner-wrapper').css("width", 5000);
        },
        forceMaxWidthPayMethodsBox: function(){
//            $('.pay-methods .inner-wrapper').css("width",5000);
        },
        restartProductsPosition: function(){
            if (!sliderProducts)
                return;

            sliderProducts.restartPosition();
            sliderProducts.resize();
        },
        restartPayMethodsPosition: function(){
            if (!sliderPayMethods)
                return;

            sliderPayMethods.restartPosition();
            sliderPayMethods.resize();
        },
        goToProductN: function(num){
            $timeout(function() { sliderProducts.goToNumImage(num); }, 500);
        },
        goToPayMethodN: function(num){
            $timeout(function() { sliderPayMethods.goToNumImage(num); }, 500);
        }
    };

}]);