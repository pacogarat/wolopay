smartApp.controller('AnalyticsTransactionsPurchasesController', ['APIStats', '$scope', '$rootScope', '$log', 'Sparkline', 'Flot', '$translate', '$timeout',
    function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, $translate, $timeout) {

        $scope.dateFormat='days';

        $scope.predicate = 'date_format';
        $scope.reverse=true;

        $translate(['revenue', 'transactions', 'purchases', 'game_amount', 'analitycs.revenue_by_single_payments',
            'analitycs.transaction_purchases.amounts_game_single_payments_without_offer',
            'analitycs.transaction_purchases.amounts_game_single_payments_with_offer', 'analitycs.revenue_by_subscriptions',
            'analitycs.transaction_purchases.amounts_game_subscriptions_without_offer', 'analitycs.transaction_purchases.amounts_game_subscriptions_with_offer',
            'analitycs.no_hit', 'analitycs.unique_users_by_purchase', 'analitycs.transaction_purchases.unique_users_purchase_pie', 'analitycs.transaction_purchases.unique_users_transaction_pie',
            'analitycs.unique_users', 'others', 'analitycs.transaction_purchases.purchases_with_gifts_pie', 'analitycs.transaction_purchases.amounts_game_single_payments_with_offer'

        ]).then(function(translations){

            $scope.revenueByHours = function()
            {

                $("#flotcontainer_analitycs_3").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },
                    title: {
                        text: null
                    },

                    xAxis: [{
                        categories: Flot.getKeys($scope.data.amounts_game_single_payments_by_hours_admin_local, '','H')
                    }],
                    yAxis: [ { // Secondary yAxis
                        title: {
                            text: translations.revenue
                        },
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: [{
                        name: translations['analitycs.revenue_by_single_payments'] ,
                        type: 'column',
                        color: '#EE9A49',
                        yAxis: 0,
                        stacking: 'normal',
                        stack: 'offer',
                        tooltip: { valueSuffix: $rootScope.currency.symbol },
                        data:
                            $scope.revenue_by_hours_gamer_local_country ?
                                Flot.parseArrayKey($scope.data.amounts_game_single_payments_by_hours_gamer_country, 'hours') :
                                Flot.parseArrayKey($scope.data.amounts_game_single_payments_by_hours_admin_local, 'hours')

                    }, {
                        name: translations['analitycs.revenue_by_subscriptions'],
                        type: 'column',
                        color: '#71843F',
                        yAxis: 0,
                        stack: 'offer',
                        tooltip: { valueSuffix: $rootScope.currency.symbol },
                        stacking: 'normal',
                        data:
                            $scope.revenue_by_hours_gamer_local_country ?
                                Flot.parseArrayKey($scope.data.amounts_game_subscription_payments_by_hours_gamer_country, 'hours') :
                                Flot.parseArrayKey($scope.data.amounts_game_subscription_payments_by_hours_admin_local, 'hours')
                    }]
                });
            };

            $scope.orderBy = function(field){

                if (field == $scope.predicate)
                    $scope.reverse = !$scope.reverse;

                $scope.predicate = field;

            };

            var exe = function exe()
            {

                var dataStats = [],
                    dateFormat
                ;

                APIStats.getTransactionPurchases().success(function (data){

                    $scope.data = data;

                    angular.forEach(data.transactions_full, function(collection) {
                        collection.cr = collection.purchases / collection.transactions * 100;
                        collection.amount_game_vs_unique_users = collection.amount_game / collection.unique_users;
                    });

                    $scope.table = data.transactions_full;
                    $scope.dateFormat = data.date_format;

                    dataStats=[];

                    var xAsis=Flot.getXAxisFormatTime($scope.dateFormat);

                    $("#flotcontainer_analitycs_1_1").highcharts({
                        chart: {
                            zoomType: 'xy'
                        },

                        title: {
                            text: null
                        },
                        xAxis:
                            xAsis
                        ,
                        yAxis: [ { // Secondary yAxis
                            title: {
                                text: translations.revenue
                            },
                            opposite: true
                        }, { // Primary yAxis
                            labels: {
                                enabled: true
                            },
                            title: {
                                text:  translations.transactions

                            }
                        }, { // Primary yAxis
                            labels: {
                                enabled: true
                            },
                            opposite: true,
                            title: {
                                text:  translations.purchases
                            }
                        }],
                        tooltip: {
                            shared: true
                        },
                        legend: {
                            verticalAlign: 'top',
                            y: 35
                        },
                        series: [{
                            name: translations['analitycs.transaction_purchases.amounts_game_single_payments_without_offer'] ,
                            type: 'column',
                            color: '#EE9A49',
                            yAxis: 0,
                            stacking: 'normal',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stack: 'offer',
                            data: Flot.parseArrayKey(data.amounts_game_single_payments_without_offer, $scope.dateFormat)
                        }, {
                            name: translations['analitycs.transaction_purchases.amounts_game_single_payments_with_offer'],
                            type: 'column',
                            color: '#FFE3C7',
                            yAxis: 0,
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stack: 'offer',
                            stacking: 'normal',
                            data: Flot.parseArrayKey(data.amounts_game_single_payments_with_offer, $scope.dateFormat)
                        },{
                            name: translations['analitycs.transaction_purchases.amounts_game_subscriptions_without_offer'],
                            type: 'column',
                            color: '#71843F',
                            yAxis: 0,
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stacking: 'normal',
                            stack: 'offer',
                            data: Flot.parseArrayKey(data.amounts_game_subscriptions_without_offer, $scope.dateFormat)
                        }, {
                            name: translations['analitycs.transaction_purchases.amounts_game_subscriptions_with_offer'] ,
                            type: 'column',
                            yAxis: 0,
                            color: '#C9E57D',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stack: 'offer',
                            stacking: 'normal',
                            data: Flot.parseArrayKey(data.amounts_game_subscriptions_with_offer, $scope.dateFormat)
                        }, {
                            name: translations.transactions,
                            type: 'spline',
                            yAxis: 1,
                            data: Flot.parseArrayKey(data.transactions, $scope.dateFormat)
                        }, {
                            name: translations.purchases,
                            color: '#90ee7e',
                            type: 'spline',
                            yAxis: 2,
                            data: Flot.parseArrayKey(data.purchases, $scope.dateFormat)
                        }]
                    });

                    $scope.revenueByHours();

                    // Range
                    dataStats=[];

                    dataStats.push([translations.purchases, data.purchases_sum]);
                    dataStats.push([translations['analitycs.no_hit'], data.transactions_sum - data.purchases_sum]);

                    createSimplePieChart($('#flotcontainer_analitycs_1_2'), dataStats, translations['analitycs.transaction_purchases.purchases_with_gifts_pie'], false);

                    dataStats=[];

                    dataStats.push([translations['analitycs.unique_users_by_purchase'], data.unique_users_purchases]);
                    dataStats.push([translations['analitycs.no_hit'], data.purchases_sum - data.unique_users_purchases]);


                    createSimplePieChart($('#flotcontainer_analitycs_1_3'), dataStats, translations['analitycs.transaction_purchases.unique_users_purchase_pie'], false);

                    dataStats=[];

                    dataStats.push([translations['analitycs.unique_users'], data.unique_users_transactions]);
                    dataStats.push([translations['others'], data.transactions_sum - data.unique_users_transactions]);

                    createSimplePieChart($('#flotcontainer_analitycs_1_4'), dataStats, translations['analitycs.transaction_purchases.unique_users_transaction_pie'], false);

                    $("#flotcontainer_analitycs_2").highcharts({
                        chart: {
                            zoomType: 'xy'
                        },

                        title: {
                            text: null
                        },
        //                subtitle: {
        //                    text: 'Source: WorldClimate.com'
        //                },
                        xAxis: [{
                            categories: Flot.getKeys(data.amounts_game_single_payments_by_weekday)
                        }],
                        yAxis: [ { // Secondary yAxis
                            title: {
                                text: translations.revenue
                            },
                            opposite: true
                        }],
                        tooltip: {
                            shared: true
                        },
                        series: [{
                            name: translations['analitycs.revenue_by_single_payments'],
                            type: 'column',
                            color: '#EE9A49',
                            yAxis: 0,
                            stacking: 'normal',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stack: 'offer',
                            data: Flot.parseArrayKey(data.amounts_game_single_payments_by_weekday, 'static')
                        }, {
                            name: translations['analitycs.revenue_by_subscriptions'],
                            type: 'column',
                            color: '#71843F',
                            yAxis: 0,
                            stack: 'offer',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stacking: 'normal',
                            data: Flot.parseArrayKey(data.amounts_game_subscription_payments_by_weekday, 'static')
                        }]
                    });


                });


            };

                function createSimplePieChart(target, dataCharts, title, legendEnabled)
                {
                    target.highcharts({
                        colors: ['#7cb5ec', '#eeeeee'],
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: true
                        },
                        title: {
                            text: title,
                            align: 'center',
                            verticalAlign: 'middle',
                            floating: true,
                            margin: 0,
                            style: { fontSize : "16px"},
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            enabled: legendEnabled
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    enabled: false
                                },
                                startAngle: -90,
                                endAngle: 90,
                                slicedOffset: 0,
                                borderColor: "#dddddd"
                            }
                        },
                        series: [{
                            showInLegend: true,
                            type: 'pie',
                            innerSize: '50%',
                            data: dataCharts
                        }]
                    });
                }

            function createSimplePieChartOld(target, dataCharts, legend, label)
            {
                var rect = target.offset();

                label = label === null ? true : label;
                legend = legend || {
                    show : true,
                    noColumns : 1, // number of colums in legend table
                    labelFormatter : null, // fn: string -> string
                    labelBoxBorderColor : "#000", // border color for the little label boxes
                    container : null, // container (as jQuery object) to put legend in, null means default on top of graph
                    position : "ne", // position of default legend container within plot
                    margin : [5, 10], // distance from grid edge to default legend container within plot
                    backgroundColor :null, // null means auto-detect
                    backgroundOpacity : 1 // set to 0 to avoid background
                };

                $.plot(target, dataCharts, {
                    series : {
                        pie : {
                            show : true,
                            innerRadius : 0.5,
                            radius : 1,
                            label : {
                                show : label,
                                radius : 5 / 8,
                                formatter : function(label, series) {
                                    return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">TU NIGGAAA' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                threshold : 0.1,
                                background: {
                                    opacity: 0.5
                                }
                            }
                        }
                    },
                    legend: legend,
                    grid : {
                        hoverable : true,
                        clickable : true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                        shifts: {
                            x: rect.left,
                            y: rect.top
                        },
                        defaultTheme: false
                    }
                });
            }

            setTimeout(function(){ exe() }, 1000);

            $scope.exe = exe;

            var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
                $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
            });
            var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
                $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
            });
            var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
                $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
            });
            var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
                $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
            });

            $scope.$on("$destroy", function() {
                appWatch();
                currency();
                dateFrom();
                dateTo();
            });

    });
}]);