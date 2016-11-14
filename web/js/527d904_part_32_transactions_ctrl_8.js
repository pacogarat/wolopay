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

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            $scope.transactions = [];
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