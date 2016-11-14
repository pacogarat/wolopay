smartApp.controller('ConfiguratorSelectArticlesAndShopsController', function (APIAppShops, APIShopTemplates, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http, APIAppTabs, APIAppShopHasAppTabs, $filter) {

    $scope.tab = {};

    APIShopTemplates.getByAppId($rootScope.app.id).success(function (data){
        $scope.templates = data;
    });

    APIAppTabs.getByAppId($rootScope.app.id).success(function (data){
        $scope.appTabs = data;
    });


    APIAppShops.getCategories().success(function (data){
        $scope.categories = data;

        APIAppShopHasAppTabs.getByAppId($rootScope.app.id).success(function (appTabs){

            APIAppShops.getByAppId($rootScope.app.id).success(function (selecteds){

                angular.forEach($scope.categories, function(category){
                    angular.forEach(selecteds, function(selected){
                        if (selected.level_category.id == category.id)
                        {
                            category.selected = true;
                            category.value_lower = selected.value_lower;
                            category.value_higher = selected.value_higher;
                            category.css = selected.css;
                        }
                    });
                });

                angular.forEach($scope.categories, function(category){
                    if (!category.css)
                        category.css = {};
                });

                APIArticles.getArticleByAppId($rootScope.app.id).success(function (articles){

                    angular.forEach($scope.categories, function(category){

                        category.app_tabs = [];

                        angular.forEach(appTabs, function(appTab){

                            if (appTab.app_shop.level_category.id != category.id)
                                return false;

                            category.app_tabs.push(appTab);

                            appTab.articles = angular.copy(articles);

                            angular.forEach(appTab.articles, function(article){

                                angular.forEach(article.app_shop_has_articles, function(app_shop_has_article){

                                    if (app_shop_has_article.active == 1)
                                    {
                                        article['selected_'+app_shop_has_article.app_shop.level_category.id ] = true;
                                    }

                                });
                            });

                            appTab.articles = $scope.filterArticlesByTab(appTab.articles, appTab);
                        });
                    });

                    selectTabAvailableAuto();
                });
            });
        });
    });

    $scope.filterArticlesByTab = function (articles, appTab)
    {
        var result = [];

        angular.forEach(articles, function(article){
            var state = true, found= false;

            angular.forEach(appTab.articles, function(articleFilter){
                if (articleFilter.id == article.id)
                    found = true;
            });

            if (found==false && appTab.articles)
                state = false;

            found= false;

            angular.forEach(appTab.article_categories, function(articleFilter){
                if (articleFilter.id == article.article_category.id)
                    found = true;
            });

            if (found==false && appTab.article_categories)
                state = false;

            if (state)
                result.push(article);
        });

        return $scope.orderArticlesByAppShop(result, appTab.app_shop);
    };

    $scope.orderArticlesByAppShop = function (articles, appShop){

        angular.forEach(articles, function(article){
            angular.forEach(article.app_shop_has_articles, function(app_shop_has_article){
                if (app_shop_has_article.app_shop.level_category.id == appShop.level_category.id)
                    article.order = app_shop_has_article.order

            });
        });

        var result = $filter('orderBy')(articles, 'order');

        return result;
    };


    $scope.selectAll = function (categoryId)
    {
        angular.forEach($scope.categories, function(category){

            if (category.selected)
            {
                angular.forEach(category.app_tabs, function(app_tab){
                    angular.forEach(app_tab.articles, function(article){
                        article['selected_'+categoryId] = true;
                    });
                });
            }
        });
    };

    $scope.removeAll = function (categoryId)
    {
        angular.forEach($scope.categories, function(category){

            if (category.selected)
            {
                angular.forEach(category.app_tabs, function(app_tab){
                    angular.forEach(app_tab.articles, function(article){
                        article['selected_'+categoryId] = false;
                    });
                });
            }
        });
    };

    $scope.valueHigherChanged = function (category){
        var next=null;
        angular.forEach($scope.categories, function(categoryCurrent, key){
            if (categoryCurrent.selected)
            {
                if (next)
                    categoryCurrent.value_lower = next.value_higher;

                if (categoryCurrent.id == category.id)
                {
                    next=categoryCurrent;
                }else{
                    next=null;
                }
            }


        });

    };

    $scope.someSelected = function (){
        var result = false;

        angular.forEach($scope.categories, function(category){
            angular.forEach(category.app_tabs, function(app_tab){
                angular.forEach(app_tab.articles, function(article){
                    if (article['selected_'+category.id])
                        result = true;
                });
            });
        });

        return result;
    };

    $scope.submit = function (){
        $http.put('/admin/api/article/sync/shops/app/'+$rootScope.app.id, {categories: $scope.categories}).success(function (data){
             $rootScope.configuratorCurrent.step = 7;
        });
    };

    $scope.updateShop= function(levelCategory)
    {
        var min= 0, max=999999, last, first, before;
        angular.forEach($scope.categories, function(category){

            if (category.selected)
            {
                if (!first)
                    first = category;

                last = category;
                category.value_lower = min;

                if (category.value_higher)
                    min = category.value_higher;
            }
        });
        angular.forEach($scope.categories, function(category){

            if (first && first.id != category.id && category.value_lower === 0 )
            {
                category.value_lower = null;
            }

            if (category.value_lower == max )
                category.value_lower = null;

            if (last && category.id !== last.id)
            {
                if (category.value_higher == max)
                    category.value_higher = null;
            }
        });
        if (last)
            last.value_higher = max;

        angular.forEach($scope.articles, function(article){
            if (levelCategory.selected)
                article['selected_'+levelCategory.id] = article['selected_previous_'+levelCategory.id] || false;
            else{
                article['selected_previous_'+levelCategory.id] = article['selected_'+levelCategory.id];
                article['selected_'+levelCategory.id] = false;
            }
        });

        selectTabAvailableAuto();
    };

    function selectTabAvailableAuto(){

        $scope.tab = null;

        angular.forEach($scope.categories, function(category){
            if (category.selected && $scope.tab == null)
                $scope.tab = category;
        });

    }

});
