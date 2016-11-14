smartApp.controller('PurchasesController', ['$scope', 'APIPurchases', '$modal', '$rootScope', '$filter', '$routeParams', 'CommonFTransPurchNot',
    function ($scope, APIPurchases, $modal, $rootScope, $filter, $routeParams, CommonFTransPurchNot) {

        CommonFTransPurchNot.removeDateWhenChangeSearch($scope);

        $scope.currentPage = 0;
        $scope.search = $routeParams;
        $scope.purchases = [];
        $scope.maxCurrentPage = false;
        $scope.thereAreData = null;


        var exe = function exe(){
            APIPurchases.getAll(
                    null, null, null, null, $scope.currentPage, $scope.search.purchase_id, $scope.search.transaction_id,
                    $scope.search.country_client_id, $scope.search.country_shop_id, $scope.search.gamer_external_id,
                    $scope.search.was_canceled, $scope.search.subscription_id
            ).success(function (data){

                $scope.purchases=$.merge($scope.purchases, data);

                if (data.length > 0)
                {

                    $scope.purchases_country = $filter('unique')($scope.purchases, 'country.id');
                    $scope.purchases_country_detected = $filter('unique')($scope.purchases, 'transaction.country_detected.id');
                    $scope.purchases_gamer = $filter('unique')($scope.purchases, 'gamer.gamer_external_id');
                    $scope.purchases_pay_method = $filter('unique')($scope.purchases, 'pay_method.name');
                    $scope.purchases_level_categories = $filter('unique')($scope.purchases, 'transaction.level_category.id');
                    $scope.articles = $filter('unique_with_array_children')($scope.purchases, 'payment.payment_detail.payment_detail_has_articles');
                    $scope.offer_programmers = $filter('unique_with_array_children')($scope.purchases, 'payment.payment_detail.payment_detail_has_articles.offer_programmer');

                    $scope.currentPage++;
                }

                if (data.length < 50)
                {
                    $scope.maxCurrentPage = true;
                }

                $scope.thereAreData = $scope.purchases.length > 0;

            });
        };

        $scope.loadSearch = function(){
            $scope.purchases = [];
            $scope.currentPage = 0;
            $scope.maxCurrentPage = false;
            exe();
        };

        $scope.loadMore = function(){
            exe();
        };

        $scope.countryDetectedFilterChanged = function(country_detected_changed_id){
            if (country_detected_changed_id)
            {
                $scope.search.transaction.country_detected = {id: country_detected_changed_id};
            }
            else{
                if (typeof $scope.search.transaction.country_detected !== undefined)
                    delete $scope.search.transaction.country_detected
            }
        };

        $scope.predicate = 'created_at';
        $scope.reverse=true;

        $scope.orderBy = function(field){

            if (field == $scope.predicate)
                $scope.reverse = !$scope.reverse;

            $scope.predicate = field;

        };

        // MODAL WINDOW
        $scope.cancel = function (purchase) {
            var modalInstance = $modal.open({
                controller: "PurchaseCancelCtrl",
                templateUrl: 'purchaseCancel.html',
                resolve: {
                    purchase: function(){
                        return purchase;
                    },
                    purchases: function(){
                        return $scope.purchases;
                    }
                }
            });

        };

        // MODAL WINDOW
        $scope.reactivate = function (purchase) {
            var modalInstance = $modal.open({
                controller: "PurchaseReactivateCtrl",
                templateUrl: 'purchaseReactivate.html',
                resolve: {
                    purchase: function(){
                        return purchase;
                    },
                    purchases: function(){
                        return $scope.purchases;
                    }
                }
            });

        };

        // MODAL WINDOW
        $scope.open = function (purchase) {

            var modalInstance = $modal.open({
                controller: "PurchaseModalCtrl",
                templateUrl: 'myModalContent.html',
                resolve: {
                    purchase: function()
                    {
                        return angular.copy(purchase);
                    }
                }
            });

        };

        function resetCurrentPage()
        {
            $scope.notifications = 0;
            $scope.purchases = [];
            $scope.maxCurrentPage = false;
            $scope.currentPage = 0;
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
smartApp.controller('PurchaseModalCtrl', ['$scope', '$modalInstance', 'purchase', function ($scope, $modalInstance, purchase)
{
    $scope.purchase = purchase;

}]);
smartApp.controller('PurchaseCancelCtrl', ['$scope', '$modalInstance', 'purchase', 'purchases', 'APIPurchases', 'alerts',
    function ($scope, $modalInstance, purchase, purchases, APIPurchases, alerts)
    {
        $scope.purchase = purchase;

        $scope.ok = function (reason) {
            APIPurchases.cancelById($scope.purchase.id, reason).success(function (data, code){
                $modalInstance.dismiss('cancel');
                if (code == 202)
                {
                    alerts.addInfo('purchase_section.cancel_in_process');
                    purchase.cancel_in_process = true;
                }
                else
                {
                    alerts.addInfo();
                    purchase.was_canceled = true;
                }
            });
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }]);
smartApp.controller('PurchaseReactivateCtrl', ['$scope', '$modalInstance', 'purchase', 'purchases', 'APIPurchases', 'alerts',
    function ($scope, $modalInstance, purchase, purchases, APIPurchases, alerts)
    {
        $scope.purchase = purchase;

        $scope.ok = function (reason) {
            APIPurchases.reactivateById($scope.purchase.id, reason).success(function (data, code){
                $modalInstance.dismiss('cancel');
                purchase.cancel_in_process = false;
                alerts.addInfo();
            });
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }]);