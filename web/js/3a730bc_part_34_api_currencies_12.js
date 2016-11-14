smartApp.factory('APICurrencies' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (){
            return $http.get('/admin/api/currency');
        }

    };
}]);
