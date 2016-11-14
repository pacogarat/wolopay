angular.module('shopApp').factory('resetVars', [ '$log', '$rootScope', function ($log, $rootScope) {
    return {
        shop: function () {

            $log.debug('Normal Reset');
            $rootScope.current.articlePMPCA = $rootScope.options.forceGenericPMPC || null;
            $rootScope.current.appShopHasArticle = null;
            $rootScope.current.articlePMPCAs = null;
            $rootScope.current.appShopHasArticles = null;
            $rootScope.current.state = null;
            $rootScope.current.payMethodFixedAmount = null;
            $rootScope.gacha = null;
            this.itemTabs();

        },
        cart: function() {
            if ($rootScope.hasCart)
            {
                $rootScope.current.cart = [];
                $rootScope.current.real_cart_price = null;
                $rootScope.current.real_cart_price_eur = null;
            }
        },
        itemTabs: function() {
            angular.forEach($rootScope.current.itemTabs, function(categoryActual, index) {
                categoryActual.selected = false;
            });
        }
    };

}]);