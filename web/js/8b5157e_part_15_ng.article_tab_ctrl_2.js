angular.module('shopApp').controller('ArticleTabCtrl', ['APIArticleTab', 'APIAppShopHasArticles', 'APIArticlePMPCA', 'APICountry', '$scope', '$rootScope', 'resetVars', '$log', 'alerts', 'sliders',
    function (APIArticleTab, APIAppShopHasArticles, APIArticlePMPCA, APICountry, $scope, $rootScope, resetVars, $log, alerts, sliders) {

        function disablePreLoader()
        {
            $('.wolo-container .ready').css('visibility', 'visible');
        }

        function loadData(callback)
        {
            callback = callback || function(){};

            APIArticleTab.getAll();
            if ($rootScope.firstPayMethods)
            {

                APIArticlePMPCA.getAll();

            }else{
                APIAppShopHasArticles.getAll(null, null, function (data){
                    if ($rootScope.articleSelected)
                    {
                        angular.forEach(data, function(obj, index) {
                            if ($rootScope.articleSelected && obj.article.id == $rootScope.articleSelected.id)
                            {
                                $rootScope.articleSelected = null;
                                $rootScope.current.appShopHasArticle = obj;
                                sliders.goToProductN(index+1);
                                APIArticlePMPCA.getAll();
                            }

                        });
                    }

                    callback();
                });
            }
            disablePreLoader();
        }

        // First load, starting Process
        if (!$rootScope.current.country)
        {
            if (typeof ga !== 'undefined')
            {
                ga('send', 'exception', {
                    'exDescription': 'fixed Country, country not valid',
                    'exFatal': false
                });
            }

            disablePreLoader();
            alerts.addError('errors.country_not_valid');
            return;
        }

        loadData();

        $scope.switchArticleTab = function (articleTab)
        {
            if (articleTab.id == $rootScope.current.articleTab.id || $rootScope.current.iframe )
                return;

            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'tab change to '+articleTab.id, 'changed');
            }

            resetVars.shop();

            $rootScope.current.articleTab = articleTab;

            if ($rootScope.firstPayMethods)
                APIArticlePMPCA.getAll();
            else
                APIAppShopHasArticles.getAll();


        }


}]);