smartApp.factory('APIItems' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/item/'+appId);
        },
        deleteById: function (itemId){
            return $http.delete('/admin/api/item/'+itemId);
        }
    };
}]);
