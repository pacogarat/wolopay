smartApp.controller('NotificationsController',['$scope', 'APINotifications', '$modal', '$rootScope', '$filter',
    function ($scope, APINotifications, $modal, $rootScope, $filter) {

    $scope.currentPage = 0;
    $scope.notifications = [];
    $scope.maxCurrentPage = false;

    function exe(){
        APINotifications.getAll(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.notifications=$.merge($scope.notifications, data);
                $scope.currentPage++;
            }else{
                $scope.maxCurrentPage = true;
            }

        });
    }

    exe();

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

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.notifications = [];
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            exe();
        }
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });
}]);

smartApp.controller('NotificationModalCtrl', ['$scope', '$modalInstance', 'notification', function ($scope, $modalInstance, notification)
{
    $scope.notification = notification;

}]);