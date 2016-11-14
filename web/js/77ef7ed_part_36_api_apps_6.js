smartApp.factory('APIApps' , [ '$http', function ($http) {
    return {
        getAll: function (){
            return $http.get('/admin/api/apps');
        },
        getOneById: function (appId){
            return $http.get('/admin/api/app/'+appId);
        }
    };
}]);
