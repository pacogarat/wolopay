smartApp.controller('ActiveSubscriptionsController', ['$scope', 'APISubscription', '$modal', '$rootScope',
    function ($scope, APISubscription, $modal, $rootScope) {

        $rootScope.dateSelector = false;

        $scope.$on("$destroy", function() {
            $rootScope.dateSelector = true;
        });

        $scope.currentPage = 0;
        $scope.subscriptions = [];
        $scope.maxCurrentPage = false;


        function exe(){
            APISubscription.getActives(null, null, $scope.currentPage).success(function (data){
                if (data.length > 0)
                {
                    $scope.subscriptions=$.merge($scope.subscriptions, data);
                    $scope.currentPage++;
                }else{
                    $scope.maxCurrentPage = true;
                }
            });
        }

        $scope.loadMore = function(){
            exe();
        };

        $scope.predicate = 'created_at';
        $scope.reverse=false;

        $scope.orderBy = function(field){

            if (field == $scope.predicate)
                $scope.reverse = !$scope.reverse;

            $scope.predicate = field;

        };


        // MODAL WINDOW
        $scope.cancel = function (subscription) {
            var modalInstance = $modal.open({
                controller: "ActiveSubscriptionCancelCtrl",
                templateUrl: 'myModalContent.html',
                resolve: {
                    subscription: function()
                    {
                        return subscription;
                    }
                }
            });

        };


        function watcher(newValue, oldValue)
        {
            if (oldValue && newValue!=oldValue)
            {
                $scope.currentPage = 0;
                $scope.subscriptions = [];
                $scope.maxCurrentPage = false;
                exe();
            }
        }

        var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
            $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
        });
        var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
            $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
        });
        var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
            $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
        });
        var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
            $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
        });

        $scope.$on("$destroy", function() {
            appWatch();
            currency();
            dateFrom();
            dateTo();
        });

        exe();
}]);
smartApp.controller('ActiveSubscriptionCancelCtrl', ['$scope', '$modalInstance', 'subscription', 'APISubscription', 'alerts',
    function ($scope, $modalInstance, subscription, APISubscription, alerts)
{
    $scope.subscription = subscription;

    $scope.ok = function (reason) {
        APISubscription.cancelById($scope.subscription.id, reason).success(function (data){
            $modalInstance.dismiss('cancel');
            alerts.addInfo('active_subscription.cancel_in_process');
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
}]);