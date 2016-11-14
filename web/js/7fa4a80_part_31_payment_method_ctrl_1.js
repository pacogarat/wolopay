smartApp.controller('PaymentMethodController', ['APIStats', '$scope', '$rootScope', '$log', 'Sparkline', 'Flot', 'localize', '$timeout',
    function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, localize, $timeout) {

        function exe()
        {
            APIStats.getPaymentMethods().success(function (data){

                $scope.dateFormat = data.date_format;

                var xAsis=Flot.getXAxisFormatTime($scope.dateFormat);
                var series = [], i = 0, attemptsBy = {}, revenueBy = {}, temp;

                angular.forEach(data.table, function(collection) {

                    if (!attemptsBy[collection['pay_method']])
                    {
                        attemptsBy[collection['pay_method']] = [];
                    }

                    if (!revenueBy[collection['pay_method']])
                    {
                        revenueBy[collection['pay_method']] = [];
                    }

                    temp= {};
                    temp[collection['date_format']] = collection['pay_method_attempt'];

                    attemptsBy[collection['pay_method']].push(temp);

                    temp= {};
                    temp[collection['date_format']] = collection['amount_game'];

                    revenueBy[collection['pay_method']].push(temp);
                });

                angular.forEach(attemptsBy, function(collection, payMethod) {

                    console.log(payMethod);

                    series.push(
                        {
                            yAxis: 1,
                            type: 'area',
                            stacking: 'normal',
                            stack: 'counts',
                            name: localize.localizeText('attempts')+' '+payMethod,
                            color: Flot.increaseBrightness(Flot.getColors()[i++], 50),
                            data: Flot.parseArrayKey(collection, $scope.dateFormat)
                        }
                    );
                });

                console.log("TROFOLLEN");

                i=0;
                angular.forEach(revenueBy, function(collection, payMethod) {

                    console.log(payMethod);

                    series.push(
                        {
                            yAxis: 0,
                            type: 'column',
                            borderColor: "#777777",
                            borderWidth: 2,
                            stacking: 'normal',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            name: localize.localizeText('revenue')+' '+payMethod,
                            color: Flot.increaseBrightness(Flot.getColors()[i++], 50),
                            data: Flot.parseArrayKey(collection, $scope.dateFormat)
                        }
                    );
                });

                console.log("SERIES", series);

                $("#flotcontainer_payment_methods_1").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: localize.localizeText('analitycs.user_levels.revenue_by_level')
                    },
                    xAxis:
                        xAsis
                    ,
                    yAxis: [ {
                        min: 0,
                        labels: {
                            enabled: true
                        },
                        title: {
                            text: localize.localizeText('analitycs.user_levels.revenue_by_level')
                        }
                    }, {
                        min: 0,
                        title: {
                            text:  localize.localizeText('analitycs.user_levels.transactions_by_level')
                        },
                        labels: {
                            enabled: true
                        },
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: series
                });

                // end
            });



        }

        var running=false;
        function watcher(newValue, oldValue)
        {
            if (oldValue && newValue!=oldValue)
            {
                if (running == false)
                {
                    running = true;
                    // Prevent JavaScript function from running twice
                    $timeout(function(){

                        exe();
                        running = false;
                    }, 100);
                }
            }
        }

        var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
            watcher(newValue, oldValue);
        });
        var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
            watcher(newValue, oldValue);
        });
        var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
            watcher(newValue, oldValue);
        });
        var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
            watcher(newValue, oldValue);
        });

        $scope.$on("$destroy", function() {
            appWatch();
            currency();
            dateFrom();
            dateTo();
        });

        exe();
}]);