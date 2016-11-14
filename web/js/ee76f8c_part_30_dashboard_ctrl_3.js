smartApp.controller('DashboardController', ['$filter', 'APIStats', '$scope', '$rootScope', 'Sparkline', 'Flot', 'localize', 'Utils', '$timeout', 'tableBelow', 'Permissions',
    function ($filter, APIStats, $scope, $rootScope, Sparkline, Flot, localize, Utils, $timeout, tableBelow, Permissions) {

        $scope.jsonSparkLine = '{"chart": {"height": 30}, "tooltip": { "enabled": false }}';

    if (sessionStorage.getItem('firstTimeDashBoard') === null)
    {
        sessionStorage.setItem('firstTimeDashBoard', true);
        $scope.dashboard=false;
        console.log("Hi :)");
    }else{
        $scope.dashboard=null;
    }

        var highchartsIds = ['#flotcontainer_dashboard_1', '#flotcontainer_dashboard_3', '#flotcontainer_dashboard_4'];

        $scope.chartOnlyShowHideSerie = function(app)
        {
            $scope.chartOnlyShowSerie(app.name, app.only);
            app.only = !app.only;
        };


        $scope.chartOnlyShowSerie = function(serieName, state)
        {
            angular.forEach(highchartsIds, function(highChartId) {


                var series = $(highChartId).highcharts().series;

                angular.forEach(series, function(serie, index) {

                    if (serie.options.type == 'pie')
                    {
                        angular.forEach(serie.data, function(serie, index) {
                            if (serie.options.name_custom == serieName )
                                serie.setVisible(state);
                        });
                    }
                    else if (serie.options.name_custom == serieName )
                        serie.setVisible(state);


                });
            });
        };

        $scope.chartShowAll = function()
        {
            angular.forEach(highchartsIds, function(highChartId) {
                var series = $(highChartId).highcharts().series;

                angular.forEach(series, function(serie, index) {
                    serie.setVisible(true);
                });
            });
        };

    function exe(){

        if (!Permissions.getPermissions())
        {
            $timeout(function() {exe();}, 300);
            return;
        }

        if (!Permissions.hasPermission('ROLE_ADMIN_DASHBOARD'))
        {
            $scope.dashboard=false;
            return;
        }

        var dateFormat = 'days';

        APIStats.getAll(null, dateFormat).success(function (data){

            if (sessionStorage.getItem('firstTimeDashBoard') === true)
                $timeout(function() {$scope.dashboard= (data.apps);}, 3000);
            else
                $scope.dashboard= (data.apps);

            $timeout(function() {

                $scope.stats = data;
                $scope.amountsGameSpark = Flot.parseArrayKey(data.amounts_game, 'static');
                $scope.transactionsSpark = Flot.parseArrayKey(data.transactions, 'static');
                $scope.purchasesSpark = Flot.parseArrayKey(data.purchases, 'static');

                var toggles = $("#rev-toggles"),
                    dataStats = [],
                    name,
                    colors = Flot.getColors(),
                    aux,
                    temp= []
                ;

                $scope.actualApps = [];

                angular.forEach(data.apps, function(app, key) {
                    app.color = colors.shift();
                    aux = Utils.findObjectById($rootScope.apps, 'id', key);
                    aux.color = app.color;
                    $scope.actualApps.push(aux);
                });

                var xAsis=Flot.getXAxisFormatTime($scope.dateFormat);

                var revenuePie = [];

                // transactions
                angular.forEach(data.apps, function(app, key) {
                    appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');

                    var color = app.color;

                    temp.push({title: appName, data: app.amounts_game, color: color});

                    dataStats.push({
                        type: 'area',
                        yAxis: 1,
                        fillOpacity: 0.30,
                        stacking: 'normal',
                        stack: 'transactions',
                        name: appName+", "+localize.localizeText("transactions"),
                        data:  Flot.parseArrayKey(app.transactions, dateFormat),
                        color: Flot.increaseBrightness(color, 10),
                        name_custom: appName
                    });

                    revenuePie.push({
                        name: appName,
                        y: Math.round(app.amounts_game_sum * 100)/100,
                        color: Flot.increaseBrightness(color, 10),
                        name_custom: appName
                    });
                });

                dataStats.push({
                    type: 'pie',
                    name: localize.localizeText('revenue'),
                    borderColor: "#777777",
                    data: Flot.sortDataPieCharts(revenuePie),
                    tooltip: { valueSuffix: $rootScope.currency.symbol },
                    center: ["95%", 32],
                    innerSize: '60%',
                    size: 100,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                });

                $scope.gameAmountTable = tableBelow.createObjectByBarChart(temp, true, $rootScope.currency.symbol);

                // amounts
                angular.forEach(data.apps, function(app, key) {
                    appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');

                    var color = app.color;

                    dataStats.push({
                        type: 'column',
                        yAxis: 0,
                        borderColor: "#777777",
                        borderWidth: 1,
                        stacking: 'normal',
                        tooltip: { valueSuffix: $rootScope.currency.symbol },
                        stack: 'revenue',
                        name: appName+", "+localize.localizeText("game_amount"),
                        data:  Flot.parseArrayKey(app.amounts_game, dateFormat),
                        color: color,
                        name_custom: appName
                    });
                });

                $("#flotcontainer_dashboard_1").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
                    },
                    //                subtitle: {
                    //                    text: 'Source: WorldClimate.com'
                    //                },
                    xAxis:
                        xAsis
                    ,
                    yAxis: [ { // Secondary yAxis
                        title: {
                            text: localize.localizeText('revenue')
                        },
                        opposite: true
                    }, { // Primary yAxis
                        labels: {
                            enabled: true
                        },
                        title: {
                            text:  localize.localizeText('transactions')

                        }
                    }],
                    legend: {
                        enabled: false
                    },
                    series: dataStats
                });

                dataStats = [];
                temp = [];

                // TRANSACTIONS
                angular.forEach(data.apps, function(app, key) {
                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.transactions, color: app.color});

                    dataStats.push({
                        type: 'line',
                        name: appName+", "+localize.localizeText("transactions"),
                        data:  Flot.parseArrayKey(app.transactions, dateFormat),
                        color: app.color,
                        group: 'transactions',
                        name_custom: appName
                    });
                });

                $scope.transactionsTable = tableBelow.createObjectByBarChart(temp, true);

                $("#flotcontainer_dashboard_3").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
                    },
                    //                subtitle: {
                    //                    text: 'Source: WorldClimate.com'
                    //                },
                    xAxis:
                        xAsis
                    ,
                    yAxis: [{ // Primary yAxis
                        labels: {
                            enabled: true
                        },
                        title: {
                            text:  localize.localizeText('transactions')

                        }
                    }],
                    legend: {
                        enabled: false
                    },
                    series: dataStats
                });

                dataStats = [];
                temp = [];

                // PURCHASES
                angular.forEach(data.apps, function(app, key) {

                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.purchases, color: app.color});

                    dataStats.push({
                        type: 'line',
                        name: appName+", "+localize.localizeText("purchases"),
                        data:  Flot.parseArrayKey(app.purchases, dateFormat),
                        color: app.color,
                        name_custom: appName,
                        group: 'purchases'

                    });
                });

                $scope.purchasesTable = tableBelow.createObjectByBarChart(temp, true);


                $("#flotcontainer_dashboard_4").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },

                    title: {
                        text: null
                    },
                    //                subtitle: {
                    //                    text: 'Source: WorldClimate.com'
                    //                },
                    xAxis:
                        xAsis
                    ,
                    yAxis: [{ // Primary yAxis
                        labels: {
                            enabled: true
                        },
                        title: {
                            text:  localize.localizeText('purchases')

                        }
                    }],
                    legend: {
                        enabled: false
                    },
                    series: dataStats
                });

                // BirdsEye
                var max=0;
                $.each(data.purchases_by_country_sum, function(key, value) {
                    if (max < value)
                        max= value;
                });

                $scope.birdEyeMax = max;
                $scope.purchasesCountryTable = tableBelow.createObjectByPieChartSimple(data.purchases_by_country_sum);

                data_array = data.purchases_by_country_sum;

                function renderVectorMap() {
                    $('#vector-map').empty();
                    $('#vector-map').vectorMap({
                        map: 'world_mill_en',
                        backgroundColor: '#fff',
                        regionStyle: {
                            initial: {
                                fill: '#c4c4c4'
                            },
                            hover: {
                                "fill-opacity": 1
                            }
                        },
                        series: {
                            regions: [{
                                values: data_array,
                                scale: ['#85a8b6', '#4d7686'],
                                normalizeFunction: 'polynomial'
                            }]
                        },
                        onRegionLabelShow: function (e, el, code) {
                            if (typeof data_array[code] == 'undefined') {
                                e.preventDefault();
                            } else {
                                var countrylbl = data_array[code];
                                el.html(el.html() + ': ' + countrylbl + ', '+localize.localizeText('purchases'));
                            }
                        }
                    });
                }

                renderVectorMap();
                sessionStorage.setItem('firstTimeDashBoard', false);

//                $timeout(function() {
//                    angular.forEach($scope.gridOptions.ngGrid.rowFactory.aggCache,function(row){
//                        row.toggleExpand();
//                    });
//                }, 1000);

            }, sessionStorage.getItem('firstTimeDashBoard') === true ? 3100: 100);
        });
//         todo
//        APIStats.getPayMethods().success(function (data){
//            $scope.pay_method_stats = data;
//            $scope.pay_method_stats_original = data;
//        });
    }

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
            exe();
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