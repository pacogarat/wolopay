smartApp.controller('OfferContainerCtrl', [ '$rootScope', '$location', '$scope', 'APIOffers', 'Utils',  'alerts', '$translate', '$routeParams', '$filter',
    function ($rootScope, $location, $scope, APIOffers, Utils,  alerts, $translate, $routeParams, $filter) {



        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;

            $location.path( "/configuration/offers/list" );
        });

        function exe(){
            $rootScope.offerCurrent = {};

            if (!$routeParams.id)
                $rootScope.offerCurrent = { step: 1, local_time: false, pretty_price: true, create: true, articles_extra:[] };
            else{
                APIOffers.getByAppIdAndId($rootScope.app.id, $routeParams.id).success(function (data){
                    $rootScope.offerCurrent = data;
                    $rootScope.offerCurrent.update = true;
                    $rootScope.offerCurrent.step = 5;
                    $rootScope.offerCurrent.offer_to = new Date($rootScope.offerCurrent.offer_to);
                    $rootScope.offerCurrent.offer_from = new Date($rootScope.offerCurrent.offer_from);
                    $rootScope.offerCurrent.limit_purchases = $rootScope.offerCurrent.limit_purchases || 0;
                    $rootScope.offerCurrent.limit_per_user = $rootScope.offerCurrent.limit_per_user || 0;

                    Utils.selectAll($rootScope.offerCurrent.app_shops);
                    Utils.selectAll($rootScope.offerCurrent.countries);
                    Utils.selectAll($rootScope.offerCurrent.articles);

                    angular.forEach($rootScope.offerCurrent.countries, function(value) {
                        value.continent.selected = true;
                    });

                    if ($rootScope.offerCurrent.articles_extra.length > 0)
                        $rootScope.offerCurrent.articles_extra = Utils.getArrayFromObjectId($rootScope.offerCurrent.articles_extra);
                });
            }
        }



        $scope.goBack = function (step)
        {
            if (step < $rootScope.offerCurrent.step)
                $rootScope.offerCurrent.step = step;
        };

        $scope.sendOffer = function ()
        {
            if ($rootScope.offerCurrent.update)
            {
                APIOffers.update($rootScope.app.id, $rootScope.offerCurrent.id, $rootScope.offerCurrent.name, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops),
                        Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.countries), Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.articles),
                        $rootScope.offerCurrent.articles_extra.join(","),
                        $rootScope.offerCurrent.offer_from.toISOString(), $rootScope.offerCurrent.offer_to.toISOString(),
                        $rootScope.offerCurrent.local_time, $rootScope.offerCurrent.amount_percent_discount, $rootScope.offerCurrent.quantity_extra_percent,
                        $rootScope.offerCurrent.limit_purchases, $rootScope.offerCurrent.limit_per_user, $rootScope.offerCurrent.pretty_price
                    )
                    .success(function (data){
                        $rootScope.offerCurrent.create = false;
                        $rootScope.offerCurrent.update = true;
                        alerts.addInfo('action_completed');
                    }).error(function(data, status, headers, config) {
                        if (status == 422)
                            alerts.addError($translate('offer.conflicts_with_other_offer', {'%offer_name%': data.message.toString()}));
                    });
            }else{
                APIOffers.insert($rootScope.app.id, $rootScope.offerCurrent.name, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops),
                        Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.countries), Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.articles),
                        $rootScope.offerCurrent.articles_extra.join(","),
                        $rootScope.offerCurrent.offer_from.toISOString(), $rootScope.offerCurrent.offer_to.toISOString(),
                        $rootScope.offerCurrent.local_time, $rootScope.offerCurrent.amount_percent_discount, $rootScope.offerCurrent.quantity_extra_percent,
                        $rootScope.offerCurrent.limit_purchases, $rootScope.offerCurrent.limit_per_user, $rootScope.offerCurrent.pretty_price
                    )
                    .success(function (data){
                        $rootScope.offerCurrent.id = data.id;
                        $rootScope.offerCurrent.create = false;
                        $rootScope.offerCurrent.update = true;
                        alerts.addInfo('action_completed');
                    }).error(function(data, status, headers, config) {
                        if (status == 422)
                            alerts.addError($translate('offer.conflicts_with_other_offer', {'%offer_name%': data.message.toString()}));
                    });
            }

        };

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            delete $rootScope.offerCurrent;
            $rootScope.topBoxSelectors = true;
        });

        exe();
}])

