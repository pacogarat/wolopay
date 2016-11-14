smartApp.factory('APIStats' , ['$http', '$rootScope', 'Utils', function ($http, $rootScope, Utils) {
    return {
        getTransactionPurchases: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){

            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/transaction_purchases/app/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getUserLevels: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){

            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/user_levels/app/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getPaymentMethods: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){

            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/payment_methods/app/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getAll: function (appIds, dateFormatResult, dateFrom, dateTo, currencyId){
            appIds = appIds || Utils.getCSVFromObjectId($rootScope.apps);
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/apps/'+appIds+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getPayMethods: function (appIds, dateFormatResult, dateFrom, dateTo, currencyId){
            appIds = appIds || Utils.getCSVFromObjectId($rootScope.apps);
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/pay_methods/apps/'+appIds+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        }
    };
}]);
