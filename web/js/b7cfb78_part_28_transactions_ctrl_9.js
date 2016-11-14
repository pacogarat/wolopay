smartApp.controller('TransactionsController', ['$scope', 'APITransactions', '$rootScope', '$routeParams', 'CommonFTransPurchNot',
    function ($scope, APITransactions, $rootScope, $routeParams, CommonFTransPurchNot) {

    CommonFTransPurchNot.removeDateWhenChangeSearch($scope);

    $scope.currentPage = 0;
    $scope.search = $routeParams;
    $scope.transactions = [];
    $scope.maxCurrentPage = false;
    $scope.thereAreData = null;

    function exe(){

        APITransactions.getAll(
                null, null, null, null, $scope.currentPage, $scope.search.transaction_id,
                $scope.search.country_client_id, $scope.search.gamer_external_id
            ).success(function (data){

                $scope.transactions=$.merge($scope.transactions, data);

                if (data.length > 0)
                {
                    $scope.currentPage++;
                }
                if (data.length < 50)
                {
                    $scope.maxCurrentPage = true;
                }

                $scope.thereAreData = $scope.transactions.length > 0;
        });
    }

    $scope.loadSearch = function(){
        $scope.transactions = [];
        $scope.currentPage = 0;
        $scope.maxCurrentPage = false;
        exe();
    };

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

    var resetCurrentPage = function()
    {
        $scope.transactions = [];
        $scope.currentPage = 0;
        $scope.maxCurrentPage = false;
        exe();
    };

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue,  resetCurrentPage);
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