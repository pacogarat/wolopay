smartApp.factory('APIAppShops' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/shops/app/'+appId);
        },
        getCategories: function (appId, available){
            appId = appId || $rootScope.app.id;
            available = available || '';
            return $http.get('/admin/api/app_shops_categories/'+appId+'?available='+available);
        }
    };
}]);
