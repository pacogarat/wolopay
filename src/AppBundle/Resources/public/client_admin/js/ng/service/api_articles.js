smartApp.factory('APIArticles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppIdAndShopsAndCountries: function (appId,shops,countries,locale){
            return $http.get('/admin/api/article/'+appId+'/'+shops+'/'+countries+'/'+locale);
        },
        deleteByAppIdAndArticleId: function (appId,articleId){
            return $http.delete('/admin/api/app/'+appId+'/article/'+articleId);
        },
        getArticleByAppId: function (appId, pmpc, active, appShopFilter, country){
            pmpc = pmpc || '';
            appShopFilter = appShopFilter || '';
            active = (active ? '&active=1' : '');
            country = (country ? '&country='+country : '');

            return $http.get('/admin/api/article/app/'+appId+'?app_shop_has_article_filtered='+appShopFilter+'&pmpc='+pmpc + active+country);
        },
        getByFilters: function (appId, appTabUniqueName, countryId, levelCategoryId, appTabId, articleCategoryId, articleSpecialType){
            appTabId = appTabId || '';
            countryId = countryId || '';
            levelCategoryId = levelCategoryId || '';
            appTabUniqueName = appTabUniqueName || '';
            articleCategoryId = articleCategoryId || '';
            articleSpecialType = articleSpecialType || '';

            return $http.get('/admin/api/article/simple/'+appId+'?app_tab_name_unique='+appTabUniqueName+'&app_tab_id='+appTabId+
                '&country='+countryId+'&level_category_id='+levelCategoryId+'&article_category_id='+articleCategoryId+'&article_special_type='+articleSpecialType);
        }
    };
}]);
