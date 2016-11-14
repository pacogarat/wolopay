smartApp.controller('TransactionsController', ['$scope', 'APITransactions', '$rootScope', '$routeParams', 'CommonFTransPurchNot', '$filter', 'LoadMoreScroll',
    function ($scope, APITransactions, $rootScope, $routeParams, CommonFTransPurchNot, $filter, LoadMoreScroll) {


    var loadMoreScrollHandler = null;
    CommonFTransPurchNot.removeDateWhenChangeSearch($scope);

    $scope.currentPage = 0;
    $scope.search = $routeParams;
    $scope.transactions = [];
    $scope.maxCurrentPage = false;
    $scope.thereAreData = null;

    var exe = function exe(callback){

        callback = callback || function(){};
        LoadMoreScroll.clear(loadMoreScrollHandler);

        APITransactions.getAll(
                null, null, null, null, $scope.currentPage, $scope.search.transaction_id,
                $scope.search.country_client_id, $scope.search.gamer_external_id
            ).success(function (data){

                $scope.transactions=$.merge($scope.transactions, data);

                if (data.length > 0)
                {
                    $scope.transactions_status = $filter('unique')($scope.transactions, 'status_category.name');
                    $scope.transactions_country = $filter('unique')($scope.transactions, 'country_detected.name');
                    $scope.transactions_gamer = $filter('unique')($scope.transactions, 'gamer.gamer_external_id');
                    $scope.transactions_shops = $filter('unique')($scope.transactions, 'level_category.id');

                    $scope.currentPage++;
                }

                if (data.length == 0)
                {
                    $scope.maxCurrentPage = true;

                }else{
                    loadMoreScrollHandler = LoadMoreScroll.onScroll(function(callback){ exe(callback); });
                }

                $scope.thereAreData = $scope.transactions.length > 0;
                callback();

        });
    };

    $scope.loadSearch = function(){
        $scope.transactions = [];
        $scope.currentPage = 0;
        $scope.maxCurrentPage = false;
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
        LoadMoreScroll.clear(loadMoreScrollHandler);
    });

    exe();
}]);