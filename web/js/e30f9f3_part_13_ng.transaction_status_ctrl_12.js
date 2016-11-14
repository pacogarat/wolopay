shopApp
    .controller('TransactionStatusCtrl', function (alerts, $scope, socketFactory, HandleTransactionStatus, $log, $rootScope, $timeout) {

        angular.element(document).ready(function() {
            var socket=socketFactory.get();

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
        });

});