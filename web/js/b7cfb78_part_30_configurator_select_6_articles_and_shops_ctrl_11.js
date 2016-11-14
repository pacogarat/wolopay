smartApp.controller('ConfiguratorSelectArticlesAndShopsController', ['APIAppShops', 'APILanguages', 'APIShopTemplates', 'APIArticles', 'APIPayMethods', '$scope', 'Utils', '$rootScope', 'APIAppTabs', 'APIAppShopHasAppTabs', '$filter', 'APIArticleCategories', 'APIPayCategories', '$modal', '$http', 'Watchers', 'LogTime',
    function (APIAppShops, APILanguages, APIShopTemplates, APIArticles, APIPayMethods, $scope, Utils, $rootScope, APIAppTabs, APIAppShopHasAppTabs, $filter, APIArticleCategories, APIPayCategories, $modal, $http, Watchers, LogTime) {

        var dirtyBefore = $rootScope.configuratorCurrent.dirty;
        Watchers.formIsDirty('form_articles_in_shop', $scope, function(){ $rootScope.configuratorCurrent.dirty = true });

        $scope.tab = {};
        LogTime.time("START");


        function generateUniqueName(name)
        {
            return name.replace(' ', '_').toLowerCase();
        }

        $scope.validateIsUniqueName = function(appTabActual)
        {
            angular.forEach($scope.appTabs, function(appTab){
                appTab.name_unique = generateUniqueName(appTab.name);
            });

            var valid = true;
            angular.forEach($scope.appTabs, function(appTab){
                if (appTabActual.name_unique == appTab.name_unique && appTab !== appTabActual)
                    valid = false;
            });

            return valid;
        };

        APIShopTemplates.getByAppId($rootScope.app.id).success(function (data){
            $scope.templates = data;
        });

        $scope.onChangeArticleCategory = function(){
            angular.forEach($scope.categories, function(category){
                angular.forEach(category.app_shop_has_app_tabs, function(app_shop_has_app_tab){
                    $scope.filterArticlesByTab(app_shop_has_app_tab.articles, app_shop_has_app_tab);
                });
            });
            visibilityHiddenIfArticleIsSelected();
        };


        $scope.sortableOptions = {
            handle: '.move',
            stop: function(e, ui) {
                reorderAppTabs();
            }
        };

        function reorderAppTabs(){
            angular.forEach($scope.appTabs, function(appTab, index){
                appTab.order = index+1;
            });

            angular.forEach($scope.categories, function(category){
                category.app_shop_has_app_tabs = $filter('orderBy')(category.app_shop_has_app_tabs, 'app_tab.order');
            });
        }

        function deSelectArticlesByAppTabArticles()
        {
            angular.forEach($scope.categories, function(category){
                angular.forEach(category.app_shop_has_app_tabs, function(appShopHasAppTabs){

                    if (!appShopHasAppTabs.articlesFilter)
                        return;

                    angular.forEach(appShopHasAppTabs.articles, function(article){
                        var found = false;
                        angular.forEach(appShopHasAppTabs.articlesFilter, function(articleFilter){
                            if (articleFilter.id == article.id)
                                found = true
                        });

                        if (!found)
                            article['selected_'+category.id] = false;
                    });
                });
            });
        }

        function removeAllAppShopHasArticles()
        {
            angular.forEach($scope.categories, function(category){
                angular.forEach(category.app_shop_has_app_tabs, function(appShopHasAppTabs){
                    angular.forEach(appShopHasAppTabs.articles, function(article){
                        article.app_shop_has_articles = null;
                    });
                });
            });
        }

        function visibilityHiddenIfArticleIsSelected()
        {
            angular.forEach($scope.categories, function(category){
                angular.forEach(category.app_shop_has_app_tabs, function(appShopHasAppTabs){
                    angular.forEach(appShopHasAppTabs.articles, function(article){

                        if (!article['selected_' + category.id])
                            return;

                        angular.forEach(category.app_shop_has_app_tabs, function(appShopHasAppTabsDeep){
                            if (appShopHasAppTabs.app_tab.id != appShopHasAppTabsDeep.app_tab.id)
                            {
                                angular.forEach(appShopHasAppTabsDeep.articles, function(articleDeep){

                                    if (articleDeep.id == article.id && !articleDeep['selected_'+category.id])
                                    {
                                        articleDeep.visible = false;
                                    }

                                });
                            }
                        });

                        article.visible = true;
                    });
                });
            });
        }


        $scope.deleteImage = function (appTab){
            $http.delete('/admin/api/app_tab/app/'+$rootScope.app.id+'/photo/'+appTab.id).success(function() {
                appTab.image.img = null;
            });
        };

        $scope.removeAppTab = function(appTab){

            angular.forEach($scope.categories, function(category){
                angular.forEach(category.app_shop_has_app_tabs, function (appShopHasAppTabs, index){
                    if (appTab === appShopHasAppTabs.app_tab)
                        category.app_shop_has_app_tabs.splice(index, 1);
                });
            });

            angular.forEach($scope.appTabs, function(appTabX, index){
                if (appTabX === appTab)
                    $scope.appTabs.splice(index, 1);
            });

        };

        $scope.addOneTab = function(){
            var newObject = {};
            $scope.appTabs.push(newObject);

            angular.forEach($scope.categories, function(category){
                var newAppShopHasAppTab = angular.copy(category.app_shop_has_app_tabs[0]);
                newAppShopHasAppTab.app_tab = newObject;
                newAppShopHasAppTab.id = null;
                category.app_shop_has_app_tabs.push(newAppShopHasAppTab);

                angular.forEach(newAppShopHasAppTab.articles, function(article, index){
                    article = angular.copy(article);
                    article['selected_'+category.id] = false;
                    newAppShopHasAppTab.articles[index] = article;
                });

            });

            visibilityHiddenIfArticleIsSelected();
        };

        APIAppShops.getCategories().success(function (data){
            $scope.categories = data;

            APIAppTabs.getByAppId($rootScope.app.id).success(function (data){
                $scope.appTabs = data;

                APIPayCategories.getAll().success(function (data){
                    $scope.payCategories = data;

                    angular.forEach($scope.payCategories, function(payCategory){
                        angular.forEach($scope.appTabs, function(appTab){
                            angular.forEach(appTab.pay_categories, function(appTabPayCategory, key){
                                if (appTabPayCategory.id == payCategory.id)
                                    appTab.pay_categories[key] = payCategory;
                            });
                        });
                    });

                });

                APIArticleCategories.getAll().success(function (data){
                    $scope.articleCategories = data;

                    // sync objects
                    angular.forEach($scope.articleCategories, function(articleCategory){
                        angular.forEach($scope.appTabs, function(appTab){
                            angular.forEach(appTab.article_categories, function(appArticleCategory, key){
                                if (appArticleCategory.id == articleCategory.id)
                                    appTab.article_categories[key] = articleCategory;
                            });
                        });
                    });
                });

                APIAppShopHasAppTabs.getByAppId($rootScope.app.id).success(function (appShopHasAppTabs){

                    // sync objects
                    angular.forEach(appShopHasAppTabs, function(appShopHasAppTab, key){
                        angular.forEach($scope.appTabs, function(appTab){

                            if (appShopHasAppTab.app_tab.name_unique == appTab.name_unique)
                            {
                                appShopHasAppTabs[key].app_tab = appTab;
                            }

                        });


                    });


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

                            LogTime.time("AFTER ARTICLES");
                            var articlesJson = JSON.stringify(articles);

                            angular.forEach($scope.categories, function(category){

                                category.app_shop_has_app_tabs = [];

                                angular.forEach($scope.appTabs, function(appTab){
                                    var new_app_shop_has_app_tabs = {};

                                    LogTime.time("JSON");
                                    new_app_shop_has_app_tabs.articles = JSON.parse(articlesJson);
                                    LogTime.timeEnd("JSON");
                                    new_app_shop_has_app_tabs.app_tab = appTab;
                                    new_app_shop_has_app_tabs.app_shop = {level_category: {id: category.id}};

                                    angular.forEach(appShopHasAppTabs, function(app_shop_has_app_tab){

                                        if (!app_shop_has_app_tab || app_shop_has_app_tab.app_shop.level_category.id != category.id)
                                            return false;

                                        if (app_shop_has_app_tab.app_tab.name_unique == appTab.name_unique)
                                        {
                                            new_app_shop_has_app_tabs.articlesFilter = app_shop_has_app_tab.articles;
                                        }

                                    });

                                    angular.forEach(new_app_shop_has_app_tabs.articles, function(article){

                                        angular.forEach(article.app_shop_has_articles, function(app_shop_has_article){

                                            if (app_shop_has_article.active == 1)
                                            {
                                                article['selected_'+app_shop_has_article.app_shop.level_category.id ] = true;
                                                article.visible = true;
                                            }

                                        });
                                    });

                                    category.app_shop_has_app_tabs.push(new_app_shop_has_app_tabs);
                                    new_app_shop_has_app_tabs.articles = $scope.filterArticlesByTab(new_app_shop_has_app_tabs.articles, new_app_shop_has_app_tabs, true);

                                });

                            });

                            LogTime.timeEnd("AFTER ARTICLES");
                            LogTime.time("MAIN");

                            deSelectArticlesByAppTabArticles();
                            selectTabAvailableAuto();
                            reorderAppTabs();
                            visibilityHiddenIfArticleIsSelected();
                            removeAllAppShopHasArticles();

                            LogTime.timeEnd("MAIN");

                            // Hack Reset form state
                            if (!dirtyBefore)
                                $rootScope.configuratorCurrent.dirty = false;

                            $scope.form_articles_in_shop.$setDirty(false);
                            $scope.form_articles_in_shop.$setPristine(true);
                            // end Hack

                            LogTime.timeEnd("START");

                        });
                    });
                });
            });
        });



        $scope.onlySelectOneArticlePerTab = function (articleSelected, appTabSelected, categorySelected)
        {
            angular.forEach($scope.categories, function(category){

                if (categorySelected.id == category.id)
                {
                    angular.forEach(category.app_shop_has_app_tabs, function(appShopHasAppTabs){

                        if (appTabSelected !== appShopHasAppTabs.app_tab )
                        {
                            angular.forEach(appShopHasAppTabs.articles, function(article){
                                if (articleSelected.id == article.id)
                                {
                                    article['selected_'+category.id] = false;
                                    article.visible = articleSelected['selected_'+category.id] ? false : true ;
                                }

                                if (article.visible)
                                {
                                    article.visible = filterArticleByTab(article, appShopHasAppTabs.app_tab);
                                }

                                if (!article.visible)
                                    article['selected_'+category.id] = false;
                            });

                        }
                    });
                }
            });
        };



        function filterArticleByTab(article, appTab)
        {
            var state = true, found= false;

            angular.forEach(appTab.article_categories, function(articleFilter){
                if (articleFilter.id == article.article_category.id)
                    found = true;
            });

            if (found==false && appTab.article_categories && appTab.article_categories.length > 0)
                state = false;

            return state;
        }

        $scope.filterArticlesByTab = function (articles, appShopHasAppTab, orderToo)
        {
            orderToo = orderToo || false;

            angular.forEach(articles, function(article){

                article.visible = filterArticleByTab(article, appShopHasAppTab.app_tab)

            });

            if (!orderToo)
                return articles;

            return $scope.orderArticlesByAppShop(articles, appShopHasAppTab.app_shop);
        };

        $scope.orderArticlesByAppShop = function (articles, appShop){

            angular.forEach(articles, function(article){
                angular.forEach(article.app_shop_has_articles, function(app_shop_has_article){
                    if (app_shop_has_article.app_shop.level_category.id == appShop.level_category.id)
                        article.order = app_shop_has_article.order

                });
            });

            return $filter('orderBy')(articles, 'order');
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
                angular.forEach(category.app_shop_has_app_tabs, function(app_shop_has_app_tab){
                    angular.forEach(app_shop_has_app_tab.articles, function(article){
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

        $scope.someCategorySelected = function()
        {
            var result = false;

            angular.forEach($scope.categories, function(category){
                if (category.selected)
                    result = true;
            });

            return result;
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

        APILanguages.getAll($rootScope.app.id).success(function (data){
            $scope.languages = data;
        });


        $scope.uploadImage = function(appTab)
        {
            $modal.open({
                controller: "AppTabUpLoadCtrl",
                templateUrl: 'app_tab_image.html',
                resolve: {
                    appTab: function()
                    {
                        return appTab;
                    }
                }
            });
        }

}]).controller('AppTabUpLoadCtrl', ['appTab', '$scope', '$modalInstance', 'alerts', '$rootScope',
        function (appTab, $scope, $modalInstance, alerts, $rootScope)
    {

    $scope.appTab = appTab;

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.uploadComplete  = function (content){

        if (content.id)
        {
            if (!appTab.id)
            {
                appTab.id = content.id;
            }
            appTab.image = content.image;

            $modalInstance.dismiss('cancel');

        }else if (typeof content == 'object'){
            alerts.addError(content.message);
        }else{
            alerts.addError('internal_server_error');
        }
        $rootScope.loading = false;
    };


}]);
