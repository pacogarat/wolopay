angular.module('shopApp')
    .controller('TransactionStatusCtrl', function (alerts, $scope, socketFactory, HandleTransactionStatus, $log, $rootScope, $timeout) {

        function whenSocketReady(socket)
        {
            socket.on('connect', function () {
                $log.debug('Connected :) ');
                socket.emit('response_set_transaction', $rootScope.current.transactionId);

                socket.on('send_transaction_updated', function (data) {

                    HandleTransactionStatus.verify(
                        function (){

                            if ($rootScope.return)
                                $timeout( function (){window.location.replace($rootScope.return);}, 5000);

                            if ($('#iframe').is(":visible"))
                                alerts.addInfo('infos.payment_received');

                        },
                        function (){ alerts.addWarning('warnings.session_expired'); }
                    );
                });

            });
        }

        socketFactory.get(whenSocketReady);

});