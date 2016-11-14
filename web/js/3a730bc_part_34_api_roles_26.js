smartApp.factory('APIRoles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId){
            appId = appId || $rootScope.app.id;

            return $http.get('/admin/api/roles/'+appId);
        }
    };
}]);
