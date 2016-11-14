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
        getArticlesShops: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){

            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/articles_shops/app/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
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
        getContinentsCountries: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){

            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/continents_countries/app/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getAll: function (appIds, dateFormatResult, dateFrom, dateTo, currencyId){
            appIds = appIds || Utils.getCSVFromObjectId($rootScope.apps);
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/stats/apps/'+appIds+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getPayMethodsByGames: function (payMethods, appIds, dateFormatResult, dateFrom, dateTo, currencyId){
            appIds = appIds || Utils.getCSVFromObjectId($rootScope.apps);
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';
            payMethods = payMethods ? '1' : '';

            return $http.get('/admin/api/stats/pay_methods/apps/'+appIds+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult+'?show_pay_methods='+payMethods);
        },
        getAllPurch: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){
            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'auto';

            return $http.get('/admin/api/purchases/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId);
        }
    };
}]);
