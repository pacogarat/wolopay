smartApp.controller('ConfiguratorSelectArticlesAndShopsController', function (APIAppShops, APIShopTemplates, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http) {

    $scope.tab = {};

    APIShopTemplates.getByAppId($rootScope.app.id).success(function (data){
        $scope.templates = data;
    });

    APIAppShops.getCategories().success(function (data){
        $scope.categories = data;

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

            APIArticles.getArticleByAppId($rootScope.app.id).success(function (data){
                $scope.articles = data;

                angular.forEach(data, function(row){
                    angular.forEach(row.app_shop_has_articles, function(app_shop_has_article){

                        if (app_shop_has_article.active == 1)
                            row['selected_'+app_shop_has_article.app_shop.level_category.id ] = true;

                    });
                });

                selectTabAvailableAuto();
            });



        });

    });

    $scope.selectAll = function (categoryId)
    {
        angular.forEach($scope.articles, function(article){
            article['selected_'+categoryId] = true;
        });
    };

    $scope.removeAll = function (categoryId)
    {
        angular.forEach($scope.articles, function(article){
            article['selected_'+categoryId] = false;
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
            angular.forEach($scope.articles, function(article){
                if (article['selected_'+category.id])
                    result = true;
            });
        });

        return result;
    };

    $scope.submit = function (){
        $http.put('/admin/api/article/sync/shops/app/'+$rootScope.app.id, {categories: $scope.categories, articles: $scope.articles}).success(function (data){
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
