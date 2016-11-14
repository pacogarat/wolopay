angular.module('shopApp').controller('RegisterCashCtrl', ['$scope', '$log', '$rootScope', 'state', 'APIArticlePMPCA', 'routing', 'pageTransition',
    function ($scope, $log, $rootScope, state, APIArticlePMPCA, routing, pageTransition) {

        var oldArticlePMPCAs, oldArticlePMPCA;

        $scope.toggleWallet = function (){
            if (!$rootScope.current.walletOpen) {
                $rootScope.current.walletOpen = true;

                oldArticlePMPCAs = $rootScope.current.articlePMPCAs;
                oldArticlePMPCA = $rootScope.current.articlePMPCA;

                $rootScope.current.articlePMPCAs = [];

                APIArticlePMPCA.getAllDirectPayment($rootScope.current.country.id);

            }else {
                $rootScope.current.articlePMPCAs = oldArticlePMPCAs;
                $rootScope.current.articlePMPCA  = oldArticlePMPCA;
                $rootScope.current.walletOpen = false;
            }

            state.refresh();
        };

        $scope.isReady = function(){
            if ($rootScope.current.state == 'ready_to_buy')
                return true;

            return false;
        };

        $scope.gamerUpdateData = function ()
        {
            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'Gamer Update Data', 'clicked');
            }

            var url=routing.generate('gamer_update_data', {'_locale': $rootScope.current.language.id, 'transaction_id' : $rootScope.current.transactionId});
            pageTransition.iframeOpen(url);
        };

    }
]);