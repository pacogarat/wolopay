smartApp.controller('DashboardController', ['$filter', 'APIStats', '$scope', '$rootScope', 'Sparkline', 'Flot', '$translate', 'Utils', '$timeout', 'tableBelow', 'Permissions',
    function ($filter, APIStats, $scope, $rootScope, Sparkline, Flot, $translate, Utils, $timeout, tableBelow, Permissions) {

        $scope.jsonSparkLine = '{"chart": {"height": 30}, "tooltip": { "enabled": false }}';
        $scope.predicate = 'amount_game';
        $scope.reverse=true;

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

        $scope.collapse = function(table, date_format, collapse){
            angular.forEach(table, function(collection) {
                if (date_format == 'ALL' || collection.date == date_format)
                {
                    collection.collapsed = collapse;

                    angular.forEach(collection.appsTable, function(app) {
                        app.collapsed = collapse;
                    });
                }
            });
        };

        $scope.orderBy = function(field){

            if (field == $scope.predicate)
                $scope.reverse = !$scope.reverse;

            $scope.predicate = field;

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

            $translate(['revenue', 'transactions', 'purchases', 'game_amount']).then(function(translations){

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
                            name: appName+", "+translations.transactions,
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
                        name: translations.revenue,
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
                            name: appName+", "+translations.gameAmount,
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
                                text: translations.revenue
                            },
                            opposite: true
                        }, { // Primary yAxis
                            labels: {
                                enabled: true
                            },
                            title: {
                                text: translations.transactions

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
                            name: appName+", "+translations.transactions,
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
                                text:  translations.transactions

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
                            name: appName+", "+translations.purchases,
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
                                text:  translations.purchases

                            }
                        }],
                        legend: {
                            enabled: false
                        },
                        series: dataStats
                    });

                    $scope.purchasesCountryTable = tableBelow.createObjectByPieChartSimple(data.purchases_by_country_sum);

                    var purchasesByCountry = [], countryByTransactionsByDateFormatMAX = 1;

                    angular.forEach(data.purchases_by_country_sum, function(value, key) {
                        if (!key)
                            return;

                        purchasesByCountry.push({
                            code: key,
                            value: value
                        });

                        if (countryByTransactionsByDateFormatMAX < value)
                            countryByTransactionsByDateFormatMAX= value;
                    });

                    // Static
                    $('#wold_map_over_view').highcharts('Map', {
                        chart : {
                            borderWidth : 0,
                            margin: 0
                        },

                        title : {
                            text : null
                        },

                        mapNavigation: {
                            enabled: true,
                            enableMouseWheelZoom: false,
                            buttonOptions: {
                                x: 20,
                                verticalAlign: 'middle'
                            }
                        },

                        legend: {
                            title: {
                                text: translations['purchases']
                            },
                            floating: true
                        },
                        colorAxis: {
                            min: 1,
                            max: countryByTransactionsByDateFormatMAX,
                            type: 'logarithmic'
                        },
                        motion: {
                            enabled: false
                        },
                        series : [
                            {
                                type: "map",
                                data : purchasesByCountry,
                                mapData: Highcharts.maps['custom/world'],
                                joinBy: ['iso-a2', 'code'],
                                name: translations['purchases'],
                                states: {
                                    hover: {
                                        color: '#BADA55'
                                    }
                                }
                            }]
                    });


                    $('#wold_map_over_view').highcharts().mapZoom(0.6);



                    sessionStorage.setItem('firstTimeDashBoard', false);

    //                $timeout(function() {
    //                    angular.forEach($scope.gridOptions.ngGrid.rowFactory.aggCache,function(row){
    //                        row.toggleExpand();
    //                    });
    //                }, 1000);





                });
            }, sessionStorage.getItem('firstTimeDashBoard') === true ? 3100: 100);
        });

        APIStats.getPayMethodsByGames().success(function (data){

            var payMethods = {}, collection;

            angular.forEach(data, function(collection) {

                if (!payMethods[collection.date])
                {
                    payMethods[collection.date] = {
                        date: collection.date,
                        apps: {},
                        n_unique_users: 0,
                        n_transactions: 0,
                        n_clicked: 0,
                        n_purchases: 0,
                        amount_total: 0,
                        amount_game: 0,
                        collapsed: true
                    }
                }

                sum(payMethods[collection.date], collection);

                if (!payMethods[collection.date].apps[collection.app_id])
                {
                    payMethods[collection.date].apps[collection.app_id] = {
                        name: collection.app,
                        app: collection.app,
                        pay_methods: {},
                        n_unique_users: 0,
                        n_transactions: 0,
                        n_clicked: 0,
                        n_purchases: 0,
                        amount_total: 0,
                        amount_game: 0,
                        collapsed: true
                    }
                }

                sum(payMethods[collection.date].apps[collection.app_id], collection);

                payMethods[collection.date].apps[collection.app_id].pay_methods[collection.pay_method] = {
                    name: collection.pay_method,
                    pay_method: collection.pay_method,
                    n_unique_users: collection.n_unique_users,
                    n_transactions: collection.n_transactions,
                    n_clicked: collection.n_clicked,
                    n_purchases: collection.n_purchases,
                    amount_total: collection.amount_total,
                    amount_game: collection.amount_game,
                    cr: collection.n_purchases / collection.n_transactions * 100,
                    payout_vs_purchases: collection.n_purchases ? collection.amount_game / collection.n_purchases : null,
                    payout_vs_transactions: collection.n_transactions ? collection.amount_game / collection.n_transactions : null,
                };

            });

            var tablePayMethods = [];

            angular.forEach(payMethods, function(date) {

                date.cr= date.n_purchases / date.n_transactions * 100;
                date.payout_vs_purchases= date.n_purchases ? date.amount_game / date.n_purchases : null;
                date.payout_vs_transactions= date.n_transactions ? date.amount_game / date.n_transactions : null;

                date.appsTable = [];
                angular.forEach(date.apps, function(app) {

                    app.cr= app.n_purchases / app.n_transactions * 100;
                    app.payout_vs_purchases= app.n_purchases ? app.amount_game / app.n_purchases : null;
                    app.payout_vs_transactions= app.n_transactions ? app.amount_game / app.n_transactions : null;

                    app.pay_methodsTable = [];
                    angular.forEach(app.pay_methods, function(pay_method) {
                        app.pay_methodsTable.push(pay_method);
                    });

                    date.appsTable.push(app);
                });
                tablePayMethods.push(date);
            });

            $scope.tableReview = tablePayMethods;
        });
    }

    function sum(obj, valuesObj)
    {
        obj.n_unique_users += valuesObj.n_unique_users;
        obj.n_transactions+= valuesObj.n_transactions;
        obj.n_clicked+= valuesObj.n_clicked;
        obj.n_purchases+= valuesObj.n_purchases;
        obj.amount_total+= valuesObj.amount_total;
        obj.amount_game+= valuesObj.amount_game;
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