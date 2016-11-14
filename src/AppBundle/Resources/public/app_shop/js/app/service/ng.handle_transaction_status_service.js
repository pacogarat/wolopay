// Routing is external provided by FosJsBundle

angular.module('shopApp').factory('HandleTransactionStatus', ['$rootScope', '$timeout', 'APITransactionStatus', function ($rootScope, $timeout, APITransactionStatus) {

    $rootScope.text = {};

    function clearBodyState(){
        $('.wolo-container').removeClass('expired');
        $('.wolo-container').removeClass('pending');
        $('.wolo-container').removeClass('completed');
    }

    return {
        verify: function (callbackOk, callbackExpired, callbackFailed, callbackPending)
        {
            callbackOk =  callbackOk || function (data){};
            callbackExpired = callbackExpired || function (data){};
            callbackFailed = callbackFailed || function (data){};
            callbackPending = callbackPending || function (data){};

            APITransactionStatus.getCurrent(
                function(data){

                    $rootScope.status = data;

                    if (typeof ga !== 'undefined')
                        ga('send', 'event', 'transaction state changed to '+data.transaction.status_category.id, 'changed');

                    $rootScope.current.inProvider=false;

                    // single payment and subscription Active
                    if (data.transaction.status_category.id == 200 || data.transaction.status_category.id == 201 )
                    {
                        $rootScope.current.tutorialEnabled = false;
                        callbackOk();
                        if (typeof ga !== 'undefined')
                        {
                            ga('send', {
                                'hitType': 'event',          // Required.
                                'eventCategory': 'shop',   // Required.
                                'eventAction': 'purchase',      // Required.
                                'eventLabel': 'purchase',
                                'eventValue': 1
                            });
                        }
                        clearBodyState();
                        $('.wolo-container').addClass('completed');
                        $rootScope.text.payment_type = 'completed.payment_type_category.' + data.payment_process.type;
                        $rootScope.text.payment_status = 'completed.payment_status_category.' +  data.transaction.status_category.id;
                        $rootScope.current.state = 'completed';
                        $rootScope.current.tutorialEnabled = 0;

                    }else if (data.transaction.status_category.id == 50 || data.transaction.status_category.id == 100 ){

                        callbackPending();
                        clearBodyState();
                        $('.wolo-container').addClass('pending');

                    }else if (data.transaction.status_category.id == 1000 ){

                        callbackExpired();
                        clearBodyState();
                        $('.wolo-container').addClass('expired');
                        $rootScope.current.tutorialEnabled = 0;
                        $rootScope.current.state = 'expired';
                    }
                }
            );
        }

    };
}]);