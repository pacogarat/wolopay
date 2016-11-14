angular.module('shopApp').factory('sliders', ['$timeout', '$rootScope', '$log', 'Device', function ( $timeout, $rootScope, $log, Device) {

    var sliderProducts, sliderPayMethods ;

    function waitForElement(){

        if($('.products .arrow-right').length > 0){

            sliderProducts = new Slider('.products', ".section-custom", $rootScope.productsRows, true);
        }
        else{
            setTimeout(function(){

                waitForElement();
            },250);
        }
    }

    function waitForElement2(){

        if ($rootScope.options.hasPayMethodsSection && $('.pay-methods .arrow-right').length > 0)
        {
            sliderPayMethods = new Slider('.pay-methods', ".section-custom", $rootScope.payMethodsRows, true);
        }else{
            setTimeout(function(){
                waitForElement2();
            },250);
        }
    }

    waitForElement();
    waitForElement2();

    function reset(slider)
    {
        if (slider)
            $timeout(function(){slider.resize();}, 50);
    }

    $(window).resize(function() {

        var oldPositionImageProduct = sliderProducts.getCurrentImgProduct();
        var oldPositionImagePayMethod = sliderPayMethods.getCurrentImgProduct();

        if (sliderProducts)
            reset(sliderProducts);

        if (sliderPayMethods)
            reset(sliderPayMethods);

        sliderProducts.restorePosition(oldPositionImageProduct);
        sliderPayMethods.restorePosition(oldPositionImagePayMethod);

        $rootScope.device.hasMouse = (Device.hasMouse() && Device.isBigScreen());

    });

    return {


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
            $log.debug("--- go to product: "+num);
            $timeout(function() { sliderProducts.goToNumImage(num); }, 500);
        },
        goToPayMethodN: function(num){
            $log.debug("go to paymethod: "+num);
            $timeout(function() { sliderPayMethods.goToNumImage(num); }, 500);
        }
    };

}]);