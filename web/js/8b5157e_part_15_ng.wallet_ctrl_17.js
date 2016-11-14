angular.module('shopApp').controller('WalletCtrl', ['$rootScope', '$scope', 'APIWallet',
    function ($rootScope, $scope, APIWallet) {

        if ($rootScope.options.walletConf.wallet_is_enabled && !$rootScope.options.walletConf.wallet_in_real_money)
            APIWallet.getConfByCountry();

        $rootScope.current.newDeposit = {
            amount: 0,
            amountVirtual: 0
        };

        $rootScope.calculateVirtualAmount = function(amountVirtual){

            var range;
            angular.forEach($rootScope.options.walletConf.app_wallet_virtual_ranges, function(virtualRange, index) {
                if (virtualRange.value_lower <= amountVirtual && virtualRange.value_higher > amountVirtual )
                    range = virtualRange
            });

            if (!range && $rootScope.options.walletConf.app_wallet_virtual_ranges.length > 0)
                range = $rootScope.options.walletConf.app_wallet_virtual_ranges[$rootScope.options.walletConf.app_wallet_virtual_ranges.length-1];

            return amountVirtual * range.amount;
        };
}]);