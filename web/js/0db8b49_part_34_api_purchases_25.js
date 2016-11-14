smartApp.factory('APIPurchases' , ['$http', '$rootScope', 'RowsCalculator', function ($http, $rootScope, RowsCalculator) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page, purchaseIdFilter, transactionIdFilter, countryClientIdFilter
            , countryShopIdFilter, gamerExternalIdFilter, wasCanceledFilter, subscriptionIdFilter){
                appId = appId || $rootScope.app.id;

            if (purchaseIdFilter || transactionIdFilter || countryClientIdFilter ||
                 countryShopIdFilter || gamerExternalIdFilter || wasCanceledFilter || subscriptionIdFilter)
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

                purchaseIdFilter = purchaseIdFilter || '';
                transactionIdFilter = transactionIdFilter || '';
                countryClientIdFilter = countryClientIdFilter || '';
                countryShopIdFilter = countryShopIdFilter || '';
                gamerExternalIdFilter = gamerExternalIdFilter  || '';
                wasCanceledFilter = wasCanceledFilter || '';
                subscriptionIdFilter = subscriptionIdFilter || '';

                return $http.get('/admin/api/purchases/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page+
                    '&transaction_id='+transactionIdFilter+'&country_client_id='+countryClientIdFilter +
                    '&country_shop_id='+countryShopIdFilter +
                    '&gamer_external_id='+gamerExternalIdFilter+'&was_canceled='+wasCanceledFilter+'&purchase_id='+purchaseIdFilter+
                    '&subscription_id='+subscriptionIdFilter+'&rows='+RowsCalculator.getByScreenHeight()
                );
        },
        cancelById: function (purchaseId, reason, appId){
            appId = appId || $rootScope.app.id;
            reason = reason || '';

            return $http.post('/admin/api/app/'+appId+'/purchase/'+purchaseId+'/cancel', {reason: reason});
        },
        reactivateById: function (purchaseId, reason, appId){
            appId = appId || $rootScope.app.id;
            reason = reason || '';

            return $http.post('/admin/api/app/'+appId+'/purchase/'+purchaseId+'/reactivate', {reason: reason});
        }
    };
}]);
