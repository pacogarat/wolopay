smartApp.controller('OfferSelectShopController', ['$scope', '$rootScope', 'APIAppShops', 'Utils',
    function ($scope, $rootScope, APIAppShops, Utils) {

    APIAppShops.getByAppId($rootScope.app.id).success(function(data){
        $rootScope.offerCurrent.app_shops = Utils.reselectPreviousSession1Level(data, $rootScope.offerCurrent.app_shops);
    });

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.app_shops, function(value) {
            if (value.selected)
                result = true;
        });

        return result;
    };

}]);
