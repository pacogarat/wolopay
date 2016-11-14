angular.module('shopApp').controller('PayMethodsFixedAmountCtrl', [ '$rootScope', '$scope', 'routing', 'APIPayMethodsFixedAmount',
    function ($rootScope, $scope, routing, APIPayMethodsFixedAmount) {

        $scope.selectSayMethodFixedAmount = false;

        APIPayMethodsFixedAmount.getAll(null, null, function(data){

            if (data.length == 1)
            {
                $rootScope.current.payMethodFixedAmount = data[0];
                $rootScope.current.state = 'ready_to_buy';

            }else{
                $scope.selectSayMethodFixedAmount = true;
            }

        });

        $scope.close = function(){

            if ($rootScope.current.payMethodFixedAmount)
                $rootScope.current.state = 'ready_to_buy';
            else
                $rootScope.current.state = null;

            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'promo close window', 'clicked');
            }
        };

        $scope.selectPayMethodFixed = function (payMethodFixed){

            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'operator '+payMethodFixed.operator.name+' selected', 'clicked');
            }

            $rootScope.current.payMethodFixedAmount = payMethodFixed;
            $rootScope.current.state = 'ready_to_buy';
        };
    }
]);