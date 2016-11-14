angular.module('shopApp').controller('ArticlesPMPCAListCtrl', ['$scope', '$rootScope', '$translate', 'APIAppShopHasArticles', 'state',
    function ($scope, $rootScope, $translate, APIAppShopHasArticles, state) {

        $scope.activate = function (articlePMPCA)
        {
            if ($rootScope.current.appShopHasArticle == null && !$rootScope.firstPayMethods && $rootScope.current.cart.length <= 0)
                return;

            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'paymethod '+articlePMPCA.name+' selected', 'clicked');
            }

            $rootScope.current.articlePMPCA = articlePMPCA;

            if (!$rootScope.firstPayMethods && $scope.current.cart.length > 0 )
                $rootScope.oldPMPCASelected = articlePMPCA;

            if ($rootScope.firstPayMethods)
            {
                $rootScope.current.appShopHasArticle = null;
                APIAppShopHasArticles.getAll();
            }


            state.refresh();

        }

}]);