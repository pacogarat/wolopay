angular.module('shopApp').factory('APIArticlePMPCA' , ['$http', 'routing', '$rootScope', 'resetVars', 'sliders','$timeout', 'ArticleHelper', 'state', function ($http, routing, $rootScope, resetVars, sliders, $timeout, ArticleHelper, state) {
    return {
        getAll: function (country, article_id, successCallBackOk){

            if (!$rootScope.options.hasPayMethodsSection)
            {
                if ($rootScope.options.forceGenericPMPC)
                {
                    $rootScope.current.articlePMPCA = $rootScope.options.forceGenericPMPC;
                }

                return;
            }

            country = country || $rootScope.current.country.id;
            if ($rootScope.firstPayMethods)
                article_id = null;
            else{

                if ($rootScope.current.cart.length > 0)
                {
                    if (!article_id)
                    {
                        article_id = ArticleHelper.getArticleIdsCSV($rootScope.current.cart);
                    }

                }

                article_id = article_id || $rootScope.current.appShopHasArticle.article.id;
            }

            successCallBackOk = successCallBackOk || function (data){};

            var params = { transaction_id: $rootScope.current.transactionId, 'country' : country, 'tab_category_id': $rootScope.current.articleTab.app_tab.name_unique, '_format' : 'json'};

            if (article_id)
                params.article_id = article_id;

            var url = routing.generate('api_pay_method_get_pay_methods', params);
            $rootScope.current.articlePMPCAs = null;

            $http.get(url).success(
                function (data){
                    $rootScope.current.articlePMPCAs = data;
                    $rootScope.current.state = null;

                    if (!$rootScope.firstPayMethods && $rootScope.oldPMPCASelected)
                    {
                        $rootScope.current.articlePMPCA = $rootScope.oldPMPCASelected;
                        state.refresh();
                    }

                    successCallBackOk(data);
                })
            ;

        }

    };
}]);
