smartApp.factory('APISubscription' , ['$http', '$rootScope', 'RowsCalculator', function ($http, $rootScope, RowsCalculator) {
    return {
        getActives: function (appId, currencyId, page, subscriptionIdFilter, transactionIdFilter, purchaseIdFilter, gamerExternalIdFilter){
            appId = appId || $rootScope.app.id;
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            subscriptionIdFilter = subscriptionIdFilter || '';
            transactionIdFilter = transactionIdFilter || '';
            purchaseIdFilter = purchaseIdFilter || '';
            gamerExternalIdFilter = gamerExternalIdFilter  || '';

            return $http.get('/admin/api/app/'+appId+'/subscriptions/active/'+currencyId+'?page='+page+
                '&subscription_id='+subscriptionIdFilter+'&transaction_id='+transactionIdFilter+'&purchase_id='+purchaseIdFilter+
                '&gamer_external_id='+gamerExternalIdFilter+'&rows='+RowsCalculator.getByScreenHeight()
            );
        },
        cancelById: function (subscriptionId, reason, appId){
            appId = appId || $rootScope.app.id;
            reason = reason || '';

            return $http.post('/admin/api/active-subscriptions/cancel/'+appId+'/'+subscriptionId, {reason: reason});
        }
    };
}]);
