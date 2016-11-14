smartApp.factory('APIPurchases' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page){
            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            return $http.get('/admin/api/purchases/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page);
        }
    };
}]);
