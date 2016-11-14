smartApp.factory('APINotifications' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page, purchaseNotificationIdFilter, purchaseIdFilter, transactionIdFilter
            ,gamerExternalIdFilter, wasReceivedFilter, subscriptionIdFilter)
        {
            appId = appId || $rootScope.app.id;

            if (purchaseNotificationIdFilter || purchaseIdFilter || transactionIdFilter  || gamerExternalIdFilter ||
                wasReceivedFilter || subscriptionIdFilter)
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

            purchaseNotificationIdFilter = purchaseNotificationIdFilter || '';
            purchaseIdFilter = purchaseIdFilter || '';
            transactionIdFilter = transactionIdFilter || '';
            gamerExternalIdFilter = gamerExternalIdFilter  || '';
            wasReceivedFilter = wasReceivedFilter  || '';
            subscriptionIdFilter = subscriptionIdFilter  || '';

            return $http.get('/admin/api/app/'+appId+'/notifications/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page+
                '&transaction_id='+transactionIdFilter+'&purchase_notification_id='+purchaseNotificationIdFilter+'&purchase_id='+purchaseIdFilter+
                '&gamer_external_id='+gamerExternalIdFilter+'&was_received='+wasReceivedFilter+'&subscription_id='+subscriptionIdFilter
            );
        },
        resend: function(appId, purchaseNotificationId){
            appId = appId || $rootScope.app.id;

            return $http.post('/admin/api/app/'+appId+'/notifications/'+purchaseNotificationId+'/force_resend/');
        }
    };
}]);
