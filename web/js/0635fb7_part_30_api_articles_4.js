smartApp.factory('APIArticles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppIdAndShopsAndCountries: function (appId,shops,countries,locale){
            return $http.get('/admin/api/article/'+appId+'/'+shops+'/'+countries+'/'+locale);
        },
        getArticleByAppId: function (appId, pmpc, active){
            pmpc = pmpc || '';
            active = (active ? '&active=1' : '');
            return $http.get('/admin/api/article/app/'+appId+'?pmpc='+pmpc + active);
        }
    };
}]);
