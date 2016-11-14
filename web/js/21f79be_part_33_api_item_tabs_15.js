smartApp.factory('APIItemTabs' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/app/'+appId+'/item_tab');
        }
    };
}]);
