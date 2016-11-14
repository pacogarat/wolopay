smartApp.factory('APIInvoices' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (year){
            return $http.get('/admin/api/invoices/?year='+year);
        }
    };
}]);
