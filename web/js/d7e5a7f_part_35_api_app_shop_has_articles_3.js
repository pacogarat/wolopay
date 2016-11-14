smartApp.factory('APIAppShopHasArticles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/app_shop_has_articles/app/'+appId);
        },
        getByArticleId: function (articleId){
            return $http.get('/admin/api/app_shop_has_articles/article/'+articleId);
        }
    };
}]);
