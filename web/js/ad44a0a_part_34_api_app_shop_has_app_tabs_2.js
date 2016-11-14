smartApp.factory('APIAppShopHasAppTabs' , [ '$http', function ($http) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/app_shop_has_app_tabs/'+appId);
        }
    };
}]);
