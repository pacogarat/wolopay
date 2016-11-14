shopApp.controller('ArticlesListCtrl', function (APIAppShopHasArticles, APIArticlePMPCA, $scope, $rootScope, $timeout, sliders, $translate, state) {

    $scope.calculateTime = function (timeString)
    {
        date = new Date(timeString);
        return date.getTime();
    };

    $scope.activate = function (appShopHasArticle)
    {
        if ($rootScope.current.appShopHasArticle && appShopHasArticle.article.id == $rootScope.current.appShopHasArticle.article.id)
            return;

        if (typeof ga !== 'undefined')
        {
            $translate(appShopHasArticle.name_label.key, {number : (appShopHasArticle.items_number )}).then(function (translation) {
                ga('send', 'event', 'Article: '+translation+' selected', 'clicked');
            });

        }

        $rootScope.current.appShopHasArticle = appShopHasArticle;

        if (!$rootScope.firstPayMethods)
        {
            $rootScope.current.articlePMPCA = null;
            APIArticlePMPCA.getAll();
        }

        sliders.restartPayMethodsPosition();

        state.refresh();
    };

});