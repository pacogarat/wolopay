smartApp.controller('TransactionsController', ['$scope', 'APITransactions', '$rootScope', function ($scope, APITransactions, $rootScope) {
    $scope.currentPage = 0;
    $scope.transactions = [];
    $scope.maxCurrentPage = false;
    function exe(){
        APITransactions.getAll(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.transactions=$.merge($scope.transactions, data);
                $scope.currentPage++;
            }else{
                $scope.maxCurrentPage = true;
            }
        });
    }

    $scope.loadMore = function(){
        exe();
    };

    $scope.predicate = 'begin_at';
    $scope.reverse=true;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

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