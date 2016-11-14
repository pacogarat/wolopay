smartApp.factory('APIDocuments' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (year){
            return $http.get('/admin/api/documents/?year='+year);
        }
    };
}]);
