smartApp.controller('ConfiguratorSelectPricesController', ['APIAppShopHasArticles', 'APIAppShops', 'APIApps', 'APICountries', 'APIArticles', 'APIPayMethods', '$scope', 'Utils', '$rootScope', '$http', 'Watchers', '$log', '$filter',
    function (APIAppShopHasArticles, APIAppShops, APIApps, APICountries, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http, Watchers, $log, $filter) {

        Watchers.formIsDirty('form_prices', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

        APIApps.getAutoConfigurationAction($rootScope.app.id).success(function (data){
            $scope.autoConfiguration = data;
        });

        $scope.free = {article_category: { id: 'free'}};
        $scope.single = {article_category: { id: 'single_payment'}};
        $scope.subscription = {article_category: { id: 'subscription'}};
        $scope.appShopSelected = {};

        APICountries.getByAppId($rootScope.app.id).success(function (data){
            $scope.countries = data;
            $scope.onChangeCountry(data[0]);

        });



        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.appShops = data;
            $scope.categories = data;
            $scope.appShopSelected = data[0];
        });
        var loadingChangeCountry = false;

        $scope.onChangeCountry = function (country){

            if (loadingChangeCountry)
            {
                $log.info("Waiting for response, please wait");
                return;
            }

            if (!country.loaded)
            {
                loadingChangeCountry = true;
                APIArticles.getArticleByAppId($rootScope.app.id, null, true, null, country.id).success(function (data){
                    var articleSaved, appShopModified, appShopHasArticleC, appShopUpdated;

                    if (!$scope.articles)
                    {
                        // first time called
                        country.loaded = true;
                        $scope.countrySelected = country;
                        loadingChangeCountry = false;
                        $scope.articles = data;
                        return;
                    }

                    for (var i = 0; i < data.length; ++i) {
                        articleSaved = Utils.findObjectById($scope.articles, 'id', data[i].id);
                        if (!articleSaved)
                        {
                            continue;
                        }


                        for (var key = 0, length = articleSaved.app_shop_has_articles.length; key < length; ++key)
                        {
                            appShopUpdated = articleSaved.app_shop_has_articles[key];
                            // search to clean temp values and replace new values with temp values
                            if (appShopUpdated.country.id == country.id)
                            {
                                for (var ii = 0; ii < data[i].app_shop_has_articles.length; ++ii)
                                {
                                    appShopHasArticleC = data[i].app_shop_has_articles[ii];

                                    if (appShopHasArticleC.country.id == country.id)
                                        appShopHasArticleC.current_amount_without_offer = appShopUpdated.current_amount_without_offer;

                                    articleSaved.app_shop_has_articles.splice(key, 1);

                                    length--;
                                    key--;
                                }
                            }
                        }

                        articleSaved.app_shop_has_articles = articleSaved.app_shop_has_articles.concat(data[i].app_shop_has_articles);
                        $log.debug(articleSaved.app_shop_has_articles , 'search by', data[i].id, data[i].app_shop_has_articles);
                    }

                    country.loaded = true;
                    $scope.countrySelected = country;
                    loadingChangeCountry = false;
                });
            }else{
                $scope.countrySelected = country;
            }

        };

        $scope.getAppShopHasArticlesCurrent = function(articleCategoryId)
        {
            if (!$scope.articles)
                return [];

            var article, appShopHasArticle, result = [];

            for (var i =0; i < $scope.articles.length; i++)
            {
                article = $scope.articles[i];
                if (article.article_category.id !== articleCategoryId)
                    continue;

                for (var ii =0; ii < article.app_shop_has_articles.length; ii++)
                {
                    appShopHasArticle = article.app_shop_has_articles[ii];
                    if ($scope.appShopSelected.level_category.id == appShopHasArticle.app_shop.level_category.id && appShopHasArticle.country.id == $scope.countrySelected.id)
                        result.push([article, appShopHasArticle]);
                }
            }

            return result;
        };

        $scope.modifyPriceByArticleAmountStandard = function(article, typeForce) {

            var appShop, country;
            for (var i = 0; i < $scope.countries.length; ++i)
            {
                country = $scope.countries[i];

                for (var ii = 0; ii < $scope.appShops.length; ++ii)
                {
                    (function(){
                        var appShopHasArticle;
                        appShop = $scope.appShops[ii];

                        appShopHasArticle = Utils.findObjectById(article.app_shop_has_articles, ['app_shop.level_category.id', 'country.id'], [appShop.level_category.id, country.id]);
    //                    console.log("FFF", appShop, country.id, appShopHasArticle, article);

                        if (!appShopHasArticle)
                        {
                            if (country.loaded == true)
                                return; // skip this article is not enabled with this app

                            appShopHasArticle = {country: country, app_shop: appShop};
                            article.app_shop_has_articles.push(appShopHasArticle);
                        }

                        if (article.amount_standard === 0)
                        {
                            appShopHasArticle.current_amount_without_offer = 0;

                        }else{

                            if ((!$scope.autoConfiguration.cost_of_live_is_enabled && !typeForce) || typeForce == 'costOfLive')
                            {
                                $log.debug("costOfLive");
                                APICountries.getCostOfLife(
                                    article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id, $scope.autoConfiguration.pretty_price_is_enabled
                                ).success(function (data){
                                    appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                                });

                            }else{
                                $log.debug("Normal Exchange");
                                APICountries.getExchange(
                                    article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id, $scope.autoConfiguration.pretty_price_is_enabled
                                ).success(function (data){
                                    appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                                });
                            }
                        }
                    })();
                }
            }
        };

        $scope.modifyPriceByCostOfLifeByCountry = function() {
            angular.forEach($scope.articles, function(article){

                $scope.modifyPriceByArticleAmountStandard(article, 'forceCostOfLife');

            });
        };

        $scope.modifyPriceByCurrencyByCountry = function() {
            angular.forEach($scope.articles, function(article){

                $scope.modifyPriceByArticleAmountStandard(article, 'forceExchange');

            });
        };

        $scope.submit = function (){
            $http.put('/admin/api/article/sync/prices/app/'+$rootScope.app.id, {articles: $scope.articles}).success(function(data){
                $rootScope.configuratorCurrent.step++;
            });
        };

}]);
