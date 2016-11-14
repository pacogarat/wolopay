smartApp.controller('ConfiguratorPreConfigureController', ['$scope', '$rootScope', 'APIApps', 'APIPayMethods', 'APICurrencies',
    function ($scope, $rootScope, APIApps, APIPayMethods, APICurrencies) {

        APIApps.getAutoConfigurationAction($rootScope.app.id).success(function (data){

            if (!data.app_wallet_virtual_ranges || data.app_wallet_virtual_ranges.length == 0)
                data.app_wallet_virtual_ranges = [{value_lower: 0, value_higher: 99999999999999}];

            $scope.autoConfiguration = data;

            APICurrencies.getAll().success(function (data){
                $scope.currencies = data;

                if (!$scope.autoConfiguration.wallet_virtual_currency)
                    return;

                angular.forEach(data, function(currency, key) {
                    if (currency.id == $scope.autoConfiguration.wallet_virtual_currency.id) {
                        $scope.autoConfiguration.wallet_virtual_currency = currency;
                    }
                });
            });
        });



        $scope.removeWalletVirtual = function (range){
            $scope.autoConfiguration.app_wallet_virtual_ranges.splice(
                $scope.autoConfiguration.app_wallet_virtual_ranges.indexOf(range), 1
            );
        };

        $scope.valueHigherChanged = function (walletRange){
            var next=null;
            angular.forEach($scope.autoConfiguration.app_wallet_virtual_ranges, function(wallet, key) {

                if (next) {
                    wallet.value_lower = walletRange.value_higher;
                    (function(){
                        console.log(wallet, walletRange);
                    })();

                }

                if (wallet === walletRange) {
                    next=true;

                }else{

                    next=null;
                }
            });
        };

        $scope.addNewWalletVirtual = function ()
        {
            var latsValue = $scope.autoConfiguration.app_wallet_virtual_ranges[$scope.autoConfiguration.app_wallet_virtual_ranges.length-1].value_higher ;

            if (latsValue == 99999999999999)
            {
                latsValue = null;
                $scope.autoConfiguration.app_wallet_virtual_ranges[$scope.autoConfiguration.app_wallet_virtual_ranges.length-1].value_higher = null;
            }

            $scope.autoConfiguration.app_wallet_virtual_ranges.push(
                {
                    value_lower: $scope.autoConfiguration.app_wallet_virtual_ranges[$scope.autoConfiguration.app_wallet_virtual_ranges.length-1].value_higher,
                    value_higher: 99999999999999
                }
            );
        };

        $scope.$watchCollection('autoConfiguration', function(newValue, oldValue) {

            if (oldValue && newValue.pay_methods_max_fee_provider_percent == oldValue.pay_methods_max_fee_provider_percent)
                return;

            APIPayMethods.payMethodsWithFiltersCount($rootScope.app.id, $scope.autoConfiguration).success(function (data){
                $scope.payMethodsNum = data;
            });
        });

        $scope.submit = function (){
            APIApps.postAutoConfigurationAction($rootScope.app.id, $scope.autoConfiguration).success(function (data){

                if($('#wallet_virtual_money_img').length == 0 || $('#wallet_virtual_money_img')[0].files.length == 0 ){
                    return $rootScope.configuratorCurrent.step = 1;
                }

                var formData = new FormData();
                formData.append('form[wallet_virtual_money_img][binaryContent]', $('#wallet_virtual_money_img')[0].files[0]);

                $.ajax({
                    type: 'POST',
                    url: '/admin/api/auto_configuration/app/'+$rootScope.app.id+'/currency_image',
                    data: formData,
                    // THIS MUST BE DONE FOR FILE UPLOADING
                    contentType: false,
                    processData: false,
                    success: function(data){

                        $rootScope.configuratorCurrent.step = 1;

                    }
                });

            });
        };

    }]);
