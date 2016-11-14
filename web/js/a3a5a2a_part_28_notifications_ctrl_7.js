smartApp.controller('NotificationsController',['$scope', 'APINotifications', '$modal', '$rootScope', '$filter', '$routeParams', 'CommonFTransPurchNot',
    function ($scope, APINotifications, $modal, $rootScope, $filter, $routeParams, CommonFTransPurchNot) {

    CommonFTransPurchNot.removeDateWhenChangeSearch($scope);

    $scope.currentPage = 0;
    $scope.search = $routeParams;
    $scope.notifications = [];
    $scope.maxCurrentPage = false;
    $scope.thereAreData = null;

    var exe = function exe(){
        APINotifications.getAll(null, null, null, null, $scope.currentPage, $scope.search.purchase_notification_id,
                $scope.search.purchase_id, $scope.search.transaction_id, $scope.search.gamer_external_id,
                $scope.search.was_received, $scope.search.subscription_id
        ).success(function (data){

            $scope.notifications=$.merge($scope.notifications, data);

            if (data.length > 0)
            {
                $scope.notif_articles = $filter('unique_with_array_children')($scope.notifications, 'payment_detail_has_article');
                $scope.notif_gamer = $filter('unique_with_array_children')($scope.notifications, 'purchases');
                $scope.notif_attempts = $filter('unique')($scope.notifications, 'attempts');

                $scope.currentPage++;
            }

            if (data.length < 50)
            {
                $scope.maxCurrentPage = true;
            }

            $scope.thereAreData = $scope.notifications.length > 0;

        });
    };

    exe();

    $scope.forceResend = function (purchaseNotification){
        APINotifications.resend(null, purchaseNotification.id).success(function(data){
            if (data.response.http_code >= 200 && data.response.http_code < 300)
                purchaseNotification.was_received = true;
            else
                purchaseNotification.was_received = false;

            console.log("WTF", purchaseNotification);
            purchaseNotification.requests.push(data);

            var modalInstance = $modal.open({
                controller: "NotificationResendInformModalCtrl",
                templateUrl: 'notificationResendInformModal.html',
                resolve: {
                    notification: function(){
                        return purchaseNotification;
                    },
                    sentInfo: function(){
                        return data;
                    }
                }
            });
        });
    };

    $scope.loadSearch = function(){
        $scope.notifications = [];
        $scope.currentPage = 0;
        $scope.maxCurrentPage = false;
        exe();
    };

    $scope.loadMore = function(){
        exe();
    };

    $scope.predicate = 'created_at';
    $scope.reverse=true;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl",
            templateUrl: 'myModalContent.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };


        function resetCurrentPage()
        {
            $scope.notifications = 0;
            $scope.currentPage = 0;
            $scope.subscriptions = [];
            $scope.maxCurrentPage = false;
            exe();
        }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });
}]);

smartApp.controller('NotificationModalCtrl', ['$scope', '$modalInstance', 'notification', function ($scope, $modalInstance, notification){
    $scope.notification = notification;
}]);

smartApp.controller('NotificationResendInformModalCtrl', ['sentInfo', '$scope', '$modalInstance', 'notification', function (sentInfo, $scope, $modalInstance, notification){
    $scope.notification = notification;
    $scope.sentInfo = sentInfo;
}]);