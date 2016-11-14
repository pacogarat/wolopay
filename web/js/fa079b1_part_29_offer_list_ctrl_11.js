smartApp.controller('OfferListCtrl', function ($rootScope, $scope, APIOffers, dialogs, Utils, alerts, localize) {

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
        var dlg = dialogs.confirm();
        dlg.result.then(function(btn){
            APIOffers.deleteById(offerProgrammer.id).success(function (data){
                $scope.offers.splice( $scope.offers.indexOf(offerProgrammer), 1 );
            });
        },function(btn){

        });
    };

    exe();
});
