angular.module('shopApp').factory('resetVars', [ '$log', '$rootScope', 'APIArticlePMPCA', function ($log, $rootScope, APIArticlePMPCA) {
    return {
        shop: function () {

            $log.debug('Normal Reset');
            $rootScope.current.articlePMPCA = $rootScope.options.forceGenericPMPC || null;
            $rootScope.current.appShopHasArticle = null;
            $rootScope.current.articlePMPCAs = null;
            $rootScope.current.appShopHasArticles = null;
            $rootScope.current.state = null;
            $rootScope.current.payMethodFixedAmount = null;
            $rootScope.current.newDeposit = { amount: 0, amountVirtual: 0 };
            $rootScope.gacha = null;

            this.itemTabs();

            if ($rootScope.current.walletOpen) {
                APIArticlePMPCA.getAllDirectPayment($rootScope.current.country.id);
            }

        },
        cart: function() {
            if ($rootScope.hasCart)
            {
                $rootScope.current.cart = [];
                $rootScope.current.real_cart_price = null;
            }
        },
        itemTabs: function() {
            angular.forEach($rootScope.current.itemTabs, function(categoryActual, index) {
                categoryActual.selected = false;
            });
        }
    };

}]);