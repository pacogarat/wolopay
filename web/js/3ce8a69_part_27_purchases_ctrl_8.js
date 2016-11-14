smartApp.controller('PurchasesController', ['$scope', 'APIPurchases', '$modal', '$rootScope', '$filter',
    function ($scope, APIPurchases, $modal, $rootScope, $filter) {
    $scope.currentPage = 0;
    $scope.purchases = [];
    $scope.maxCurrentPage = false;

    function exe(){
        APIPurchases.getAll(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.transactions=$.merge($scope.purchases, data);
                $scope.purchases_country = $filter('unique')($scope.purchases, 'country.id');
                $scope.purchases_country_detected = $filter('unique')($scope.purchases, 'transaction.country_detected.id');
                $scope.purchases_gamer = $filter('unique')($scope.purchases, 'gamer.gamer_external_id');
                $scope.purchases_pay_method = $filter('unique')($scope.purchases, 'pay_method.name');
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


    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            $scope.purchases = [];
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

    exe();
}]);
smartApp.controller('PurchaseModalCtrl', ['$scope', '$modalInstance', 'purchase', function ($scope, $modalInstance, purchase)
{
    $scope.purchase = purchase;

}]);