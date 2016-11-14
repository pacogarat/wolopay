smartApp.controller('PromoListCtrl', [ '$rootScope', '$scope', 'APIPromo', 'dialogs',
    function ($rootScope, $scope, APIPromo, dialogs) {

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
            APIPromo.getByAppId($rootScope.app.id).success(function (data){
                $scope.promos = data;
            });
        }

        $scope.delete = function (offerProgrammer) {

            APIOffers.deleteById(offerProgrammer.id).success(function (data){
                $scope.offers.splice( $scope.offers.indexOf(offerProgrammer), 1 );
            });

        };

        exe();
}]);
