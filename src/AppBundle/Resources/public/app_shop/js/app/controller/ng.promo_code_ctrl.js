angular.module('shopApp').controller('PromoCodeCtrl', ['$rootScope', '$scope', 'routing', 'APIPromoCode', 'alerts',
    function ($rootScope, $scope, routing, APIPromoCode, alerts) {

        $('#promo-code-input').focus();

        $scope.close = function(){
            if ($rootScope.current.code)
                $rootScope.current.state = 'ready_to_buy';
            else
                $rootScope.current.state = null;

            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'promo close window', 'clicked');
            }

        };

        $scope.submitAndPurchase = function (){
            $scope.submit(function(){
                console.log("GOOD");
                angular.element('#button-actions .pay-button').triggerHandler('click');
            });
        };

        $scope.submit = function (successCallback){

            successCallback = successCallback || function(){
                alerts.addInfo('promo_code.code_ok');
                $scope.close();
            };

            if ($scope.code)
            {
                if (typeof ga !== 'undefined')
                {
                    ga('send', 'event', 'submit promocode', 'clicked');
                }

                APIPromoCode.isValid($scope.code,
                    function(data){

                        $rootScope.current.code = data;

                        if (typeof ga !== 'undefined')
                        {
                            ga('send', 'event', 'promocode valid', 'clicked');
                        }

                        successCallback();
                    },
                    function(data){
                        $rootScope.current.code = null;
                        alerts.addError('promo_code.invalid_code');
                        if (typeof ga !== 'undefined')
                        {
                            ga('send', 'exception', {
                                'exDescription': 'Invalid promo: '+$scope.code,
                                'exFatal': false
                            });
                        }
                    }
                );
            }
        };
    }
]);