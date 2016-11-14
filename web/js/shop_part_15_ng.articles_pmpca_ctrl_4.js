shopApp.controller('ArticlesPMPCAListCtrl', function ($scope, $rootScope, $translate, APIAppShopHasArticles, state) {

    $scope.activate = function (articlePMPCA)
    {
        if ($rootScope.current.appShopHasArticle == null && !$rootScope.firstPayMethods)
            return;

        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'paymethod '+articlePMPCA.name+' selected', 'clicked');
        }

        $rootScope.current.articlePMPCA = articlePMPCA;

        if ($rootScope.firstPayMethods)
        {
            $rootScope.current.appShopHasArticle = null;
            APIAppShopHasArticles.getAll();
        }

        state.refresh();

    }

});