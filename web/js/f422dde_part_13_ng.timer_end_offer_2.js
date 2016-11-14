shopApp.directive('timerToEndOffer',
    function() {

        return {
            restrict: 'E',

            scope: {
//                dateOffer: '=offer'
                countDown: '='
            },
            controller: function($rootScope,  $scope) {
                $scope.countDown = 'ee';
            },
            templateUrl: '/bundles/app/app_shop/js/views/partials/timer_to_end_offer.html'
        };
    });