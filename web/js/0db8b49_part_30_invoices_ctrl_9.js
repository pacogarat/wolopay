smartApp.controller('InvoicesController', ['$scope', '$rootScope', '$http', 'alerts', '$translate', 'APIInvoices',
    function ($scope, $rootScope, $http, alerts, $translate, APIInvoices) {

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            $rootScope.topBoxSelectors  = true;
        });

        $scope.searchText = {};
        var maxYear = (new Date()).getFullYear();
        $scope.currentYear = maxYear;

        function exe()
        {
            var arrayYearsAvailable = [];
            for (var i = 2015; i<maxYear+1; i++)
                arrayYearsAvailable.push(i);

            $scope.yearsAvailable = arrayYearsAvailable ;

            APIInvoices.getAll($scope.currentYear).success(function(data){
                $scope.invoices = data;
            });


        }

        $scope.onChangeCurrentYear = function (year)
        {
            if ($scope.currentYear == year)
                return;

            $scope.currentYear = year;
            exe();
        };

        $scope.activateSeparator = function(invoice, oldInvoice){

            if (!oldInvoice)
                return true;

            return oldInvoice.reference_date != invoice.reference_date;
        };

        exe();
}]);