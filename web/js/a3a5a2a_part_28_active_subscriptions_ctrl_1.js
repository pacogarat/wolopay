smartApp.controller('ActiveSubscriptionsController', ['$scope', 'APISubscription', '$modal', '$rootScope', '$routeParams', '$filter',
    function ($scope, APISubscription, $modal, $rootScope, $routeParams, $filter) {

        $rootScope.dateSelector = false;

        $scope.$on("$destroy", function() {
            $rootScope.dateSelector = true;
        });

        $scope.currentPage = 0;
        $scope.subscriptions = [];
        $scope.search = $routeParams;
        $scope.maxCurrentPage = false;
        $scope.thereAreData = null;

        function exe(){
            APISubscription.getActives(
                null, null, $scope.currentPage, $scope.search.subscription_id, $scope.search.transaction_id,
                $scope.search.purchase_id, $scope.search.gamer_external_id
            ).success(function (data){

                $scope.subscriptions=$.merge($scope.subscriptions, data);

                if (data.length > 0)
                {
                    $scope.subscriptions_articles = $filter('unique_with_array_children')($scope.subscriptions, 'payment_detail.payment_detail_has_articles');
                    $scope.subscriptions_gamer = $filter('unique')($scope.subscriptions, 'gamer.gamer_external_id');
                    $scope.subscriptions_country = $filter('unique')($scope.subscriptions, 'country.name');
                    $scope.subscriptions_renewals = $filter('unique')($scope.subscriptions, 'n_completed_payments');

                    $scope.currentPage++;
                }

                if (data.length < 50)
                {
                    $scope.maxCurrentPage = true;
                }

                $scope.thereAreData = $scope.subscriptions.length > 0;
            });
        }

        $scope.loadSearch = function(){
            $scope.subscriptions = [];
            $scope.currentPage = 0;
            $scope.maxCurrentPage = false;
            exe();
        };


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
                    subscription: function(){
                        return subscription;
                    },
                    subscriptions: function(){
                        return $scope.subscriptions;
                    }
                }
            });

        };




        function resetCurrentPage()
        {
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

        exe();
}]);
smartApp.controller('ActiveSubscriptionCancelCtrl', ['$scope', '$modalInstance', 'subscription', 'subscriptions', 'APISubscription', 'alerts',
    function ($scope, $modalInstance, subscription, subscriptions, APISubscription, alerts)
{
    $scope.subscription = subscription;

    $scope.ok = function (reason) {
        APISubscription.cancelById($scope.subscription.id, reason).success(function (data, code){
            $modalInstance.dismiss('cancel');
            if (code == 202)
                alerts.addInfo('active_subscription.cancel_in_process');
            else
            {
                alerts.addInfo();
                subscriptions.splice(subscriptions.indexOf(subscription), 1);
            }
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
}]);