smartApp.factory('APIAppTabs' , [ '$http', function ($http) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/app_tabs/'+appId);
        }
    };
}]);
