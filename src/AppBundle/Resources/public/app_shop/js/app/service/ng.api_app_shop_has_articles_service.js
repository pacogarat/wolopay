angular.module('shopApp').factory('APIAppShopHasArticles' , ['$http', 'routing', '$rootScope', 'sliders', 'alerts', '$timeout', 'ArticleHelper', 'APIArticlePMPCA',
    function ($http, routing, $rootScope, sliders, alerts, $timeout, ArticleHelper, APIArticlePMPCA) {
        return {
            getAll: function (country, article_tab_id, successCallBackOk){

                article_tab_id = article_tab_id || $rootScope.current.articleTab.app_tab.name_unique;
                country = country || $rootScope.current.country.id;
                successCallBackOk = successCallBackOk || function (data){};

                var params = { transaction_id: $rootScope.current.transactionId, 'country' : country, 'tab_category_id': article_tab_id, '_format' : 'json', 'IgnoreTranslations': 1};

                if ($rootScope.firstPayMethods)
                {
                    params.pmpc_id = $rootScope.current.articlePMPCA.id;
                }

                var url = routing.generate('api_article_get_articles', params);

                $rootScope.current.appShopHasArticles = null;

                $http.get(url).success(
                    function (data){

                        if (data.length == 0)
                            alerts.addWarning('warnings.no_articles');

                        var flag = false;

                        for (var i = 0; i < $rootScope.current.cart.length; i++) {
                            for (var id = 0; id < data.length; id++) {
                                if ($rootScope.current.cart[i].article.id == data[id].article.id)
                                {
                                    data[id].in_cart = true;
                                    flag = true;
                                }
                            }
                        }

                        if (flag && !$rootScope.firstPayMethods )
                        {
                            APIArticlePMPCA.getAll();
                        }

                        $rootScope.current.appShopHasArticles = data;

                        successCallBackOk(data);
                        $rootScope.$broadcast('apiLoadAppShopHasArticles');


                    })
                ;

            },
            calculatePrice: function (country, articles_ids, pmpc_id, successCallBackOk){

                articles_ids = articles_ids || ArticleHelper.getArticleIdsCSV($rootScope.current.cart);
                country = country || $rootScope.current.country.id;
                successCallBackOk = successCallBackOk || function (data){};

                pmpc_id = pmpc_id !== null && pmpc_id !== undefined ? pmpc_id : ($rootScope.current.articlePMPCA ? $rootScope.current.articlePMPCA.id : '');

                var params = {
                    transaction_id: $rootScope.current.transactionId,
                    'country': country,
                    'articles_ids': articles_ids,
                    '_format': 'json',
                    'IgnoreTranslations': 1,
                    'pmpc_id':  pmpc_id
                };

                var url = routing.generate('api_article_get_calculate_price_shopping_cart', params);

                $http.get(url).success(
                    function (data){
                        articlesQuantity = 0;
                        totalPriceEur = 0;
                        for (var i = 0; i < data.payment_detail_has_articles.length; i++) {
                            articlesQuantity += data.payment_detail_has_articles[i].articles_quantity;
                            totalPriceEur += data.payment_detail_has_articles[i].amount_eur;
                        }
                        data.articles_quantity = articlesQuantity;
                        data.total_amount_eur = totalPriceEur;
                        $rootScope.current.real_cart_price = data;

                        successCallBackOk(data);
                    })
                ;

            }

        };
}]);
