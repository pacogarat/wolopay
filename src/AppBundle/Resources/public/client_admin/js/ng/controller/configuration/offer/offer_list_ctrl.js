smartApp.controller('OfferListCtrl', [ '$rootScope', '$scope', 'APIOffers', 'dialogs',
    function ($rootScope, $scope, APIOffers, dialogs) {

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            $rootScope.topBoxSelectors = true;
        });

        $rootScope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;

            exe();
        });

        function exe(){
            APIOffers.getByAppId($rootScope.app.id).success(function (data){
                $scope.offers = data;
            });
        }

        $scope.delete = function (offerProgrammer) {

            APIOffers.deleteById(offerProgrammer.id).success(function (data){
                $scope.offers.splice( $scope.offers.indexOf(offerProgrammer), 1 );
            });

        };

        exe();
}]);
