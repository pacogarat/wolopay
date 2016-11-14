smartApp.factory('APIUserNotifications' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (){

            return $http.get('/admin/api/notify/notifications');
        },
        setReadById: function (clientUserNotificationId){
            return $http.get('/admin/api/notify/notifications/read/'+clientUserNotificationId);
        },
        removeAllToDate: function (date){
            return $http.delete('/admin/api/notify/notifications/'+date);
        }
    };
}]);
