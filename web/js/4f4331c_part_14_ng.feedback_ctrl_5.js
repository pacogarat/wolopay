angular.module('shopApp').controller('FeedbackCtrl', function ($rootScope, $scope, $http, routing, alerts) {

    $scope.reasonType = null;
    $scope.feedBackCompleted= false;

    $rootScope.$watch('feedback', function(newValue, oldValue) {
        if (newValue == 1)
        {
            var params = { transaction_id: $rootScope.current.transactionId, 'country' : $rootScope.current.country.id, 'article_tab_id': $rootScope.current.articleTab.id, '_format' : 'json'};
            var url = routing.generate('api_pay_method_get_pay_methods', params);

            $http.get(url).success(function (data){
                $scope.payMethods = data;
            });

            $rootScope.current.tutorialEnabled = 0;
        }
    });

    function getPayMethods()
    {
        var result = '';
        if ($scope.payMethods)
        {
            angular.forEach($scope.payMethods, function(payMethod) {
                if (payMethod.active)
                    result+= payMethod.name +', ';

            });
        }

        return (result == '' ? null : result );
    }

    $scope.send = function(){
        var params = {
            transaction_id: $rootScope.current.transactionId,
            suggest: encodeURI($scope.suggestion || ''),
            reason_type: $scope.reasonType.id
        };

        if ($scope.reasonType.id == 'it_crash_on_pay')
            params.pay_methods_failed = encodeURI(getPayMethods() || '');

        if ($scope.reasonType.id == 'i_didnt_found_a_valid_payment_method')
            params.pay_method_u_will_be_paid = encodeURI($scope.pay_method_u_will_be_paid || '');

        var url = routing.generate('feed_back', params);

        $http.get(url).success(function (data){
            $scope.payMethods = data;
            $scope.feedBackCompleted = true;
            $rootScope.feedback = false;
            alerts.addInfo('feedback.thanks_for_your_help');
        });

    };

    $scope.reasonTypes = [
        { id: 'not_interested', img: '5.png'},
        { id: 'i_will_pay_if_there_was_a_offer', img: '4.png'},
        { id: 'i_didnt_found_a_valid_payment_method', img: '3.png'},
        { id: 'it_crash_on_pay', img: '1.png'},
        { id: 'other', img: '2.png'}
    ];

    $rootScope.$on("closeBrowser", function (event, next, current) {
        $rootScope.feedback = true;
        $rootScope.$digest();
    });

    window.onbeforeunload = function (e) {
        e = e || window.event;

        return null; // Disabled

        // For IE and Firefox prior to version 4
        if ((!$rootScope.current || ($rootScope.current.state != 'completed' && $rootScope.current.state != 'expired' )) && !$scope.feedBackCompleted && $( window ).width() > 800)
        {
            $rootScope.$broadcast('closeBrowser');
            return $rootScope.beforeExit;

        }else{
            return null
        }
    };

});