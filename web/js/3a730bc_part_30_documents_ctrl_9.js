smartApp.controller('DocumentsController', ['$scope', '$rootScope', '$http', 'alerts', '$translate', 'APIDocuments',
    function ($scope, $rootScope, $http, alerts, $translate, APIDocuments) {

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
            console.log("IN");
            APIDocuments.getAll($scope.currentYear).success(function(data){
                $scope.documents = data;
            });


        }

        $scope.onChangeCurrentYear = function (year)
        {
            if ($scope.currentYear == year)
                return;

            $scope.currentYear = year;
            exe();
        };

        exe();
}]);