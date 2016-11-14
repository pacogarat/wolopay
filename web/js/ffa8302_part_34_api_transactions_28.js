smartApp.factory('APITransactions' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page, transactionIdFilter, countryClientIdFilter
            , gamerExternalIdFilter ){
                appId = appId || $rootScope.app.id;

                if (transactionIdFilter|| countryClientIdFilter ||  gamerExternalIdFilter)
                {
                    dateFrom = new Date(1);
                    dateTo = new Date();

                    dateFrom = dateFrom.toISOString();
                    dateTo = dateTo.toISOString();
                }else{
                    dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
                    dateTo = dateTo || $rootScope.dateTo.toISOString();
                }

                currencyId = currencyId || $rootScope.currency.id;
                page = page || 0;
                transactionIdFilter = transactionIdFilter || '';
                countryClientIdFilter = countryClientIdFilter || '';
                gamerExternalIdFilter = gamerExternalIdFilter  || '';

                return $http.get('/admin/api/transactions/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page +
                    '&transaction_id='+transactionIdFilter+'&country_client_id='+countryClientIdFilter +
                    '&gamer_external_id='+gamerExternalIdFilter
                );
        }
    };
}]);
