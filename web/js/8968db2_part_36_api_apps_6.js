smartApp.factory('APIApps' , [ '$http', function ($http) {
    return {
        getAll: function (){
            return $http.get('/admin/api/apps');
        },
        getIsConfigured: function (appId){
            return $http.get('/admin/api/app/'+appId+'/is_configured');
        },
        getOneById: function (appId){
            return $http.get('/admin/api/app/'+appId);
        }
    };
}]);
