smartApp.controller('ConfiguratorSelectPricesController', ['APIAppShopHasArticles', 'APIAppShops', 'APICountries', 'APIArticles', 'APIPayMethods', '$scope', 'Utils', '$rootScope', '$http', 'Watchers',
    function (APIAppShopHasArticles, APIAppShops, APICountries, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http, Watchers) {

        Watchers.formIsDirty('form_prices', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

        $scope.free = {article_category: { id: 'free'}};
        $scope.single = {article_category: { id: 'single_payment'}};
        $scope.subscription = {article_category: { id: 'subscription'}};

        APIArticles.getArticleByAppId($rootScope.app.id, null, true).success(function (data){
            $scope.articles = data;
        });

        APICountries.getByAppId($rootScope.app.id).success(function (data){
            $scope.countries = data;
            $scope.countrySelected = data[0];
        });

        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.appShops = data;
        });

        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.tab = data[0].level_category;
            $scope.categories = data;
        });

        $scope.modifyPriceByArticleAmountStandard = function(articleToModify) {
            angular.forEach($scope.articles, function(article){
                if (articleToModify.id == article.id)
                {
                    angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){

                        if (article.amount_standard === 0)
                        {
                            appShopHasArticle.current_amount_without_offer = 0;

                        }else{

                            if (!$scope.ignoreCostOfLife)
                            {

                                    APICountries.getCostOfLife(
                                            article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id, $scope.prettyPrice
                                        ).success(function (data){
                                            appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                                        });


                            }else{
                                APICountries.getExchange(
                                        article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id, $scope.prettyPrice
                                    ).success(function (data){
                                        appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                                    });
                            }

                        }

                    });
                }

            });
        };

        $scope.modifyPriceByCostOfLifeByCountry = function() {
            angular.forEach($scope.articles, function(article){

                angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){

                    if (appShopHasArticle.country.id == $scope.countrySelected.id)
                    {
                        APICountries.getCostOfLife(
                                article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id
                            ).success(function (data){
                                appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                            });
                    }

                });
            });
        };

        $scope.modifyPriceByCurrencyByCountry = function() {
            angular.forEach($scope.articles, function(article){

                angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){

                    if (appShopHasArticle.country.id == $scope.countrySelected.id)
                    {
                        APICountries.getExchange(
                                article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id
                            ).success(function (data){
                                appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                            });
                    }

                });
            });
        };

        $scope.submit = function (){
            $http.put('/admin/api/article/sync/prices/app/'+$rootScope.app.id, {articles: $scope.articles}).success(function(data){
                $rootScope.configuratorCurrent.step = 8;
            });
        };

}]);
