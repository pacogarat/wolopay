angular.module('shopApp').controller('ArticleTabCtrl', function (APIArticleTab, APIAppShopHasArticles, APIArticlePMPCA, APICountry, $scope, $rootScope, resetVars, $log, alerts, sliders) {

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

    }

    // First load, starting Process
    if ($rootScope.current.fixedCountry)
    {
        if ($rootScope.current.country)
        {
            $rootScope.current.countries = [ $rootScope.current.country ];
            loadData();
        }else{
            alerts.addError('errors.country_not_valid');
            if (typeof ga !== 'undefined')
            {
                ga('send', 'exception', {
                    'exDescription': 'fixed Country, country not valid',
                    'exFatal': false
                });
            }
        }


    }else{
        APICountry.getAll(
            function(){
                loadData();
            }
        );
    }

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


});