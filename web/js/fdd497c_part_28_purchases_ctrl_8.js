smartApp.controller('PurchasesController', ['$scope', 'APIPurchases', '$modal', '$rootScope', '$filter',
    function ($scope, APIPurchases, $modal, $rootScope, $filter) {
        $scope.currentPage = 0;
        $scope.purchases = [];
        $scope.maxCurrentPage = false;

        var exe = function exe(){
            APIPurchases.getAll(null, null, null, null, $scope.currentPage).success(function (data){
                if (data.length > 0)
                {
                    $scope.transactions=$.merge($scope.purchases, data);
                    $scope.purchases_country = $filter('unique')($scope.purchases, 'country.id');
                    $scope.purchases_country_detected = $filter('unique')($scope.purchases, 'transaction.country_detected.id');
                    $scope.purchases_gamer = $filter('unique')($scope.purchases, 'gamer.gamer_external_id');
                    $scope.purchases_pay_method = $filter('unique')($scope.purchases, 'pay_method.name');
                    $scope.purchases_level_categories = $filter('unique')($scope.purchases, 'transaction.level_category.id');
                    $scope.articles = $filter('unique_with_array_children')($scope.purchases, 'payment.payment_detail.payment_detail_has_articles');
                    $scope.offer_programmers = $filter('unique_with_array_children')($scope.purchases, 'payment.payment_detail.payment_detail_has_articles.offer_programmer');

                    $scope.currentPage++;
                }else{
                    $scope.maxCurrentPage = true;
                }

            });
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
smartApp.controller('PurchaseModalCtrl', ['$scope', '$modalInstance', 'purchase', function ($scope, $modalInstance, purchase)
{
    $scope.purchase = purchase;

}]);