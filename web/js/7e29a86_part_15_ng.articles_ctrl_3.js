angular.module('shopApp').controller('ArticlesListCtrl', [ 'APIAppShopHasArticles', 'APIArticlePMPCA', '$scope', '$rootScope', '$timeout', '$translate', 'state',
    function (APIAppShopHasArticles, APIArticlePMPCA, $scope, $rootScope, $timeout, $translate, state) {

        $scope.calculateTime = function (timeString)
        {
            var date = new Date(timeString);
            return date.getTime();
        };

        $scope.showTimerOffer = function (offer)
        {
            if (!offer.offer_to)
                return true;

            var date = new Date(offer.offer_to);
            var today = new Date();
            if (date.getTime() < (today.getTime() + (1000 *60*60*24*7)))
                return true;

            return false;
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

            state.refresh();
        };

}]);