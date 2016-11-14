angular.module('shopApp').controller('RegisterCashCtrl', ['$scope', '$log', '$rootScope',
    function ($scope, $log, $rootScope) {
        $scope.periodicityToString=function (days)
        {
            var sal = [null,null,null,null];

            if ((days % 7 ==0) &&(days<60)) {
              sal[1] = days/7;
            }else if (days < 30) {
              sal[0] = days;
            }else if (days < 365){
              sal[2] = Math.round(days/30);
            }else{
              sal[3] = Math.round(days/365);
            }

            $log.debug("Periodicity result", sal);

            return sal;
        };


    }
]);