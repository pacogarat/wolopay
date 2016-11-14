smartApp.controller('ActivityDemoCtrl', ['$rootScope', '$scope', 'APIUserNotifications', '$modal',
    function ($rootScope, $scope, APIUserNotifications, $modal) {

    var ctrl = this;
    $scope.activityShow = false;
    ctrl.getDate = function () {
        return new Date().toUTCString();
    };

    var exe = function exe()
    {
        APIUserNotifications.getAll().success(function (data){
            $scope.notifications = data;
            $scope.nNotifications = data.length;
            var total=0;
            angular.forEach($scope.notifications, function (item) {
                if (item.unread)
                    total++;
            });
            $rootScope.totalNotifications = total;
        });

        $scope.footerContent = ctrl.getDate();
    };

    $scope.refreshCallback = function () {
        exe();
    };

    $scope.clearNotificationsCallback = function(){
        if ($scope.notifications.length > 0)
        {
            APIUserNotifications.removeAllToDate($scope.notifications[0].created_at).success(function (data){
                exe();
            });
        }
    };

    $scope.items = [
        {
            title: 'notifications',
            count: 0
        }
    ];

    $scope.nNotifications = 0;

    $rootScope.totalNotifications = 0;
    angular.forEach($scope.items, function (item) {
        $rootScope.totalNotifications += item.count;
    });

    $scope.footerContent = ctrl.getDate();

    exe();

    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl",
            templateUrl: 'notificationModal.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };
}]);
smartApp.controller('NotificationModalCtrl', [ '$rootScope', '$scope', '$modalInstance', 'notification', 'APIUserNotifications',
    function ($rootScope, $scope, $modalInstance, notification, APIUserNotifications){
    $scope.notification = notification;
    if (notification.unread)
    {
        APIUserNotifications.setReadById(notification.id).success(function(data){
            notification.unread = false;
            $rootScope.totalNotifications-=1;
        });
    }

}]);