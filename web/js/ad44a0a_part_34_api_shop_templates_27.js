smartApp.factory('APIShopTemplates' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/shop_templates/app/'+appId);
        }

    };
}]);
