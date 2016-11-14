smartApp.factory('APIApps' , [function ($http) {
    return {
        getAll: function (){
            return $http.get('/admin/api/apps');
        }
    };
}]);
