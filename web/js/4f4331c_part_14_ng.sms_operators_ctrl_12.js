angular.module('shopApp').controller('SMSOperatorsCtrl', function ($rootScope, $scope, routing, APISMSOperator) {

    $scope.selectSmsOperator = false;
    APISMSOperator.getAll(null, null, function(data){

        if (data.length == 1)
        {
            $rootScope.current.operator = data[0];
            $rootScope.current.state = 'ready_to_buy';

        }else{
            $scope.selectSmsOperator = true;
        }
    });

    $scope.close = function(){

        if ($rootScope.current.operator)
            $rootScope.current.state = 'ready_to_buy';
        else
            $rootScope.current.state = null;

        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'promo close window', 'clicked');
        }
    };

    $scope.selectOperator = function (operator){

        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'operator '+operator.operator.name+' selected', 'clicked');
        }

        $rootScope.current.operator = operator;
        $rootScope.current.state = 'ready_to_buy';
    };
});