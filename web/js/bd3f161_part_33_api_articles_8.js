smartApp.factory('APIArticles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppIdAndShopsAndCountries: function (appId,shops,countries,locale){
            return $http.get('/admin/api/article/'+appId+'/'+shops+'/'+countries+'/'+locale);
        },
        getArticleByAppId: function (appId, pmpc, active){
            pmpc = pmpc || '';
            active = (active ? '&active=1' : '');
            return $http.get('/admin/api/article/app/'+appId+'?pmpc='+pmpc + active);
        },
        getByFilters: function (appId, appTabUniqueName, countryId, levelCategoryId, appTabId){
            appTabId = appTabId || '';
            countryId = countryId || '';
            levelCategoryId = levelCategoryId || '';
            appTabUniqueName = appTabUniqueName || '';

            return $http.get('/admin/api/article/simple/'+appId+'?app_tab_name_unique='+appTabUniqueName+'&app_tab_id='+appTabId+
                '&country='+countryId+'&level_category_id='+levelCategoryId);
        }
    };
}]);
