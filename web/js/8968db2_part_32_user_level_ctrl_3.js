smartApp.controller('UserLevelsController', ['APIStats', '$scope', '$rootScope', '$log', 'Sparkline', 'Flot', 'localize', '$timeout',
    function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, localize, $timeout) {

        function exe()
        {
            APIStats.getUserLevels().success(function (data){

                $scope.dateFormat = data.date_format;

                var xAsis=Flot.getXAxisFormatTime($scope.dateFormat);

                $("#flotcontainer_user_levels_1").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
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
                            text: localize.localizeText('analitycs.user_levels.user_unique_transactions')
                        }
                    }, {
                        min: 0,
                        title: {
                            text:  localize.localizeText('analitycs.user_levels.user_unique_purchases')
                        },
                        labels: {
                            enabled: true
                        },
                        opposite: true
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: [{
                        name: localize.localizeText('analitycs.user_levels.user_unique_transactions') ,
                        data: Flot.parseArrayKey(data.unique_users_transactions, $scope.dateFormat)
                    }, {
                        yAxis: 1,
                        name: localize.localizeText('analitycs.user_levels.user_unique_purchases') ,
                        data: Flot.parseArrayKey(data.unique_users_purchases, $scope.dateFormat)
                    }]
                });

                var series = [], i = 0;



                angular.forEach(data.count_level_by_shop, function(colection, shopName) {
                    series.push(
                        {
                            yAxis: 1,
                            type: 'area',
                            stacking: 'normal',
                            stack: 'counts',
                            name: localize.localizeText('transactions')+' '+shopName,
                            color: Flot.increaseBrightness(Flot.getColors()[i++], 50),
                            data: Flot.parseArrayKey(colection, $scope.dateFormat)
                        }
                    );
                });

                i = 0;

                angular.forEach(data.revenue_by_level_by_shop, function(colection, shopName) {

                    series.push(
                        {
                            yAxis: 0,
                            type: 'column',
                            borderColor: "#777777",
                            borderWidth: 1,
                            stacking: 'normal',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            stack: 'shops',
                            name: localize.localizeText('analitycs.revenue')+' '+shopName,
                            color: Flot.getColors()[i++],
                            data: Flot.parseArrayKey(colection, $scope.dateFormat)
                        }
                    );
                });

                var pieSort = Flot.parseArrayKeyText(data.revenue_by_shop_sum, 'static');
                Flot.sortDataPieCharts(pieSort);

                $("#flotcontainer_user_levels_2").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
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
                    series: series.concat(
                        {
                            type: 'pie',
                            name: localize.localizeText('revenue'),
                            borderColor: "#777777",
                            data: pieSort,
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            center: ["97%", 30],
                            innerSize: '60%',
                            size: 100,
                            showInLegend: false,
                            dataLabels: {
                                enabled: false
                            }
                        })
                });

                series = [];
                i=0;
                angular.forEach(data.level_gamers_distinct_by_shop, function(colection, shopName) {

                    series.push(
                        {
                            yAxis: 0,
                            type: 'column',
                            stacking: 'normal',
                            stack: 'shops',
                            name: localize.localizeText('analitycs.user_levels.unique_users_by_level')+' '+shopName,
                            color: Flot.getColors()[i++],
                            data: Flot.parseArrayKey(colection, $scope.dateFormat)
                        }
                    );
                });

                $("#flotcontainer_user_levels_3").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
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
                            text: localize.localizeText('analitycs.user_levels.unique_users_by_level')
                        }
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: series
                });

                $("#flotcontainer_user_levels_4").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
                    },
                    xAxis: [{
                        categories: Flot.getKeys(data.gamer_frequency)
                    }],
                    yAxis: [ {
                        min: 0,
                        labels: {
                            enabled: true
                        },
                        title: {
                            text: localize.localizeText('analitycs.user_levels.users_repeated_per_range')
                        }
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: [{
                        name: localize.localizeText('analitycs.user_levels.users_repeated') ,
                        data: Flot.parseArrayKey(data.gamer_frequency, 'static')
                    }]
                });

                $("#flotcontainer_user_levels_5").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
                    },
                    xAxis: [{
                        categories: Flot.getKeys(data.gamer_last_visit)
                    }],
                    yAxis: [ {
                        min: 0,
                        labels: {
                            enabled: true
                        },
                        title: {
                            text: localize.localizeText('analitycs.user_levels.days_beteween_last_visit_and_before')
                        }
                    }],
                    tooltip: {
                        shared: true
                    },
                    series: [{
                        name: localize.localizeText('analitycs.user_levels.users_repeated') ,
                        data: Flot.parseArrayKey(data.gamer_last_visit, 'static')
                    }]
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