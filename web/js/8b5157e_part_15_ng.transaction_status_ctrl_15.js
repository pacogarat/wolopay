angular.module('shopApp')
    .controller('TransactionStatusCtrl', ['alerts', '$scope', 'socketFactory', 'HandleTransactionStatus', '$log', '$rootScope', '$timeout',
        function (alerts, $scope, socketFactory, HandleTransactionStatus, $log, $rootScope, $timeout) {

            function whenSocketReady(socket)
            {
                socket.on('connect', function () {
                    $log.debug('Connected :) ');
                    socket.emit('response_set_transaction', $rootScope.current.transactionId);

                    socket.on('send_transaction_updated', function (data) {

                        HandleTransactionStatus.verify(
                            function (){

                                if ($rootScope.returnUrl)
                                    $timeout( function (){window.location.replace($rootScope.returnUrl);}, 5000);

                                if ($('#iframe').is(":visible"))
                                    alerts.addInfo('infos.payment_received');

                            },
                            function (){ alerts.addWarning('warnings.session_expired'); }
                        );
                    });

                    socket.on('send_wallet_updated', function (data) {

                        alerts.addInfo('infos.payment_received');

                        $log.debug('send_updated_wallet', data);
                        $rootScope.options.gamerWallet = data;
                    });

                });
            }

            socketFactory.get(whenSocketReady);
        }
]);