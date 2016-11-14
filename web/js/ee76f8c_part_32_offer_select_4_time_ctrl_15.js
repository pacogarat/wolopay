smartApp.controller('OfferSelectTimeController', ['$scope', '$rootScope', function ($scope, $rootScope) {

    $scope.minDate=new Date();

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.appShops, function(value) {
            if (value.selected)
                result = true;
        });

        return result;
    };

}]);
