smartApp.controller('PromoCodeListCtrl', [ '$rootScope', '$scope', 'APIPromoCode', 'dialogs',
    function ($rootScope, $scope, APIPromoCode, dialogs) {

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
            APIPromoCodes.getByAppId($rootScope.app.id).success(function (data){
                $scope.promo = data;
            });
        }

        $scope.delete = function (offerProgrammer) {

            APIOffers.deleteById(offerProgrammer.id).success(function (data){
                $scope.offers.splice( $scope.offers.indexOf(offerProgrammer), 1 );
            });

        };

        exe();
}]);
