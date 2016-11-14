smartApp.factory('APISubscription' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getActives: function (appId, currencyId, page){
            appId = appId || $rootScope.app.id;
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            return $http.get('/admin/api/active-subscriptions/'+appId+'/'+currencyId+'?page='+page);
        },
        cancelById: function (subscriptionId, reason, appId){
            appId = appId || $rootScope.app.id;
            reason = reason || '';

            return $http.post('/admin/api/active-subscriptions/cancel/'+appId+'/'+subscriptionId, {reason: reason});
        }
    };
}]);
