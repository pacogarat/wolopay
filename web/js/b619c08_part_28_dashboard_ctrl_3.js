smartApp.controller('DashboardController', ['$filter', 'APIStats', '$scope', '$rootScope', 'Sparkline', 'Flot', '$translate', 'Utils', '$timeout', 'tableBelow', 'Permissions', '$animate', 'CsvUtil',
    function ($filter, APIStats, $scope, $rootScope, Sparkline, Flot, $translate, Utils, $timeout, tableBelow, Permissions, $animate, CsvUtil) {

        $scope.jsonSparkLine = '{"chart": {"height": 30}, "tooltip": { "enabled": false }}';
        $scope.predicate = 'amount_game';
        $scope.reverse=true;
        $scope.loading=false;
        $scope.showPayMethods = false;

        if (sessionStorage.getItem('firstTimeDashBoard') === null)
        {
            sessionStorage.setItem('firstTimeDashBoard', true);
            $scope.dashboard=false;
            console.log("Hi :)");
        }else{
            $scope.dashboard=null;
        }

        var highchartsIds = ['#flotcontainer_dashboard_1', '#flotcontainer_dashboard_3', '#flotcontainer_dashboard_4'];

        $scope.chartShowHideSerie = function(app)
        {
            $scope.hideShowSerie(app.name);
        };

        $scope.chartOnlyShowHideSerie = function(app)
        {
            $scope.showHideOnlySerie(app.name, app.only);
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

        $scope.tableSummaryLoadTimeout = function(){
            $scope.loading = true;
            $timeout($scope.tableSummaryLoad, 200);
        };

        $scope.tableSummaryLoad = function(){
            var payMethods = {};
            APIStats.getPayMethodsByGames($scope.showPayMethods).success(function (data){

                if (payMethods)
                {
                    angular.forEach(data, function(collection) {

                        collection.country_iso = collection.country_iso || 'unknown';

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
                                n_unique_users_by_purchase: 0,
                                collapsed: true,
                                past: false
                            }
                        }
                        payMethods[collection.date].past=collection.past;

                        sum(payMethods[collection.date], collection);

                        if (!payMethods[collection.date].apps[collection.app_id])
                        {
                            payMethods[collection.date].apps[collection.app_id] = {
                                name: collection.app,
                                app: collection.app,
                                countries: {},
                                n_unique_users: 0,
                                n_transactions: 0,
                                n_clicked: 0,
                                n_purchases: 0,
                                amount_total: 0,
                                amount_game: 0,
                                n_unique_users_by_purchase: 0,
                                collapsed: true
                            }
                        }

                        sum(payMethods[collection.date].apps[collection.app_id], collection);

                        if (!payMethods[collection.date].apps[collection.app_id].countries[collection.country_iso])
                        {
                            payMethods[collection.date].apps[collection.app_id].countries[collection.country_iso] = {
                                name: collection.country_name,
                                country_name: collection.country_name,
                                country_iso: collection.country_iso,
                                pay_methods: {},
                                n_unique_users: 0,
                                n_transactions: 0,
                                n_clicked: 0,
                                n_purchases: 0,
                                amount_total: 0,
                                amount_game: 0,
                                n_unique_users_by_purchase: 0,
                                collapsed: true
                            }
                        }

                        sum(payMethods[collection.date].apps[collection.app_id].countries[collection.country_iso], collection);

                        if ($scope.showPayMethods)
                        {
                            payMethods[collection.date].apps[collection.app_id].countries[collection.country_iso ].pay_methods[collection.pay_method] = {
                                name: collection.pay_method,
                                pay_method: collection.pay_method,
                                n_unique_users: collection.n_unique_users,
                                n_transactions: collection.n_transactions,
                                n_clicked: collection.n_clicked,
                                n_purchases: collection.n_purchases,
                                n_unique_users_by_purchase: collection.n_unique_users_by_purchase,
                                amount_total: collection.amount_total,
                                amount_game: collection.amount_game,
                                cr: collection.n_purchases / collection.n_transactions * 100,
                                payout_vs_purchases: collection.n_purchases ? collection.amount_game / collection.n_purchases : null,
                                payout_vs_transactions: collection.n_transactions ? collection.amount_game / collection.n_transactions : null
                            };
                        }

                    });
                }

                var tablePayMethods = [];

                angular.forEach(payMethods, function(date) {

                    calculateEspecialOperations(date);
                    if ($scope.dateFormat == 'hours')
                        date.date = parseInt(date.date);

                    date.past= date.past;

                    date.appsTable = [];
                    angular.forEach(date.apps, function(app) {

                        calculateEspecialOperations(app);

                        app.countriesTable = [];

                        angular.forEach(app.countries, function(country) {

                            calculateEspecialOperations(country);

                            country.pay_methodsTable = [];

                            if ($scope.showPayMethods)
                            {
                                angular.forEach(country.pay_methods, function(pay_method) {
                                    country.pay_methodsTable.push(pay_method);
                                });
                            }

                            app.countriesTable.push(country);
                        });

                        date.appsTable.push(app);
                    });
                    tablePayMethods.push(date);
                });

                var tableReviewTotals = {
                    n_transactions: 0,
                    n_unique_users: 0,
                    n_clicked: 0,
                    n_purchases: 0,
                    amount_game: 0,
                    amount_total: 0,
                    n_unique_users_by_purchase: 0
                };

                angular.forEach(tablePayMethods, function(row) {
                    tableReviewTotals.n_transactions += row.n_transactions;
                    tableReviewTotals.n_unique_users += row.n_unique_users;
                    tableReviewTotals.n_clicked += row.n_clicked;
                    tableReviewTotals.n_purchases += row.n_purchases;
                    tableReviewTotals.amount_game += row.amount_game;
                    tableReviewTotals.amount_total += row.amount_total;
                    tableReviewTotals.n_unique_users_by_purchase += row.n_unique_users_by_purchase;
                });

                calculateEspecialOperations(tableReviewTotals);
                
                $scope.tableReview = tablePayMethods;
                $scope.tableReviewTotals = tableReviewTotals;

                $scope.loading = false;
            });
        };

        $scope.showHideOnlySerie = function(serieName, state)
        {
            angular.forEach(highchartsIds, function(highChartId) {

                var series = $(highChartId).highcharts().series;

                angular.forEach(series, function(serie, index) {

                    if (serie.options.type == 'pie')
                    {
                        angular.forEach(serie.data, function(serie, index) {
                            if (serie.options.name_custom != serieName )
                                serie.setVisible(state, false);
                        });
                    }
                    else if (serie.options.name_custom != serieName )
                        serie.setVisible(state, false);

                });

                $(highChartId).highcharts().redraw();
            });
        };

        $scope.hideShowSerie = function(serieName)
        {
            angular.forEach(highchartsIds, function(highChartId) {

                var series = $(highChartId).highcharts().series;

                angular.forEach(series, function(serie, index) {

                    if (serie.options.type == 'pie')
                    {
                        angular.forEach(serie.data, function(serie, index) {
                            if (serie.options.name_custom == serieName )
                                serie.setVisible(!serie.visible, false);
                        });
                    }
                    else if (serie.options.name_custom == serieName )
                        serie.setVisible(!serie.visible, false);

                });

                $(highChartId).highcharts().redraw();
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

    var exe = function exe(){

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


        APIStats.getAll().success(function (data){

            var dateFormat = data.date_format;
            $scope.dateFormat = dateFormat;

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

                    colors2 = Flot.getColors();
                    var affilate_colors = {};

                    angular.forEach(data.affiliate_purchases, function(aff, key) {
                        if (!affilate_colors[key])
                            affilate_colors[key] = colors2.shift();
                    });

                    var xAsis=Flot.getXAxisFormatTime($scope.dateFormat);

                    var revenuePie = [];

                    // transactions
                    dataStats = [];
                    temp = [];

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
                            color: Flot.increaseBrightness(color, 20),
                            name_custom: appName
                        });

                        revenuePie.push({
                            name: appName,
                            y: Math.round(app.amounts_game_sum * 100)/100,
                            color: Flot.increaseBrightness(color, 20),
                            name_custom: appName
                        });
                    });

                    dataStats.push({
                        type: 'pie',
                        name: translations.revenue,
                        borderColor: "#777777",
                        data: Flot.sortDataPieCharts(revenuePie),
                        tooltip: { valueSuffix: $rootScope.currency.symbol },
                        center: ["97%", 30],
                        innerSize: '60%',
                        size: 100,
                        showInLegend: false,
                        dataLabels: {
                            enabled: false
                        }
                    });
//                    Not used at this moment
//                    $scope.gameAmountTable = tableBelow.createObjectByBarChart(temp, true, $rootScope.currency.symbol);

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
                            name: appName+", "+translations.revenue,
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
                    //DAVIDDAVIDDAVIDDAVIDDAVIDDAVIDDAVIDDAVIDDAVID
                    // affiliates
                    var series = [], i = 0;

                    angular.forEach(data.affiliate_purchases, function(colection, affiliateName) {
                        temp.push({title: affiliateName+'-', data: colection});
                        series.push(
                            {
                                yAxis: 1,
                                type: 'area',
                                fillOpacity: 0.30,
                                stacking: 'normal',
                                stack: 'counts',
                                name: translations['transactions']+' '+affiliateName,
                                color: Flot.increaseBrightness(affilate_colors[affiliateName], 20),
                                data: Flot.parseArrayKey(colection, dateFormat)
                            }
                        );
                    });

                    i = 0;
                    angular.forEach(data.affiliate_amount_game, function(colection, affiliateName) {
                        series.push(
                            {
                                yAxis: 0,
                                type: 'column',
                                borderColor: "#777777",
                                borderWidth: 1,
                                stacking: 'normal',
                                tooltip: { valueSuffix: $rootScope.currency.symbol },
                                stack: 'shops',
                                name: translations['revenue']+' '+affiliateName,
                                color: affilate_colors[affiliateName],
                                data: Flot.parseArrayKey(colection, dateFormat)
                            }
                        );
                    });

                    var pieSort = Flot.parseArrayKeyText(data.affiliate_amount_game_sum, 'static');
                    Flot.sortDataPieCharts(pieSort);
                    var pieSort2 = [];
                    angular.forEach(pieSort, function(colection){
                        pieSort2.push({
                            y: colection[1],
                            name: colection[0],
                            color: affilate_colors[colection[0]]
                        })
                    });

                    $scope.affiliateAmountTable = tableBelow.createObjectByBarChart(temp, true, $rootScope.currency.symbol);

                    series.unshift(
                        {
                            type: 'pie',
                            name: translations['revenue'],
                            borderColor: "#777777",
                            data: pieSort2,
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            center: ["99.5%", 0],
                            innerSize: '60%',
                            size: 50,
                            showInLegend: false,
                            dataLabels: {
                                enabled: false
                            }
                        }
                    );

                    $("#flotcontainer_affiliates_1").highcharts({
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
                                text: translations['analitycs.user_levels.revenue_by_affiliate']
                            }
                        }, {
                            min: 0,
                            title: {
                                text:  translations['analitycs.user_levels.transactions_by_affiliate']
                            },
                            labels: {
                                enabled: true
                            },
                            opposite: true
                        }],
                        series: series
                    });

                    series = [];
                    i=0;

                    // END affiliates
                    //END DAVIDEND DAVIDEND DAVIDEND DAVIDEND DAVID
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

        $scope.tableSummaryLoad();

    };

        $scope.tableReviewToCSV = function()
        {
            $translate(['date', 'app', 'country', 'currency', 'dashboard.table.pay_method', 'dashboard.table.n_transactions',
            'dashboard.table.n_unique_users', 'dashboard.table.n_clicked', 'dashboard.table.n_purchases', 'cr',
            'dashboard.table.payout_vs_purchases', 'dashboard.table.payout_vs_transactions', 'dashboard.table.total',
            'dashboard.table.game_total', 'n_unique_users_by_purchase'
            ]).then(function(translations){

                CsvUtil.addToTemp(translations['date']);
                CsvUtil.addToTemp(translations['app']);
                CsvUtil.addToTemp(translations['country']);

                if ($scope.showPayMethods)
                    CsvUtil.addToTemp(translations['dashboard.table.pay_method']);

                CsvUtil.addToTemp(translations['currency']);
                CsvUtil.addToTemp(translations['dashboard.table.n_transactions']);
                CsvUtil.addToTemp(translations['dashboard.table.n_unique_users']);
                CsvUtil.addToTemp(translations['dashboard.table.n_clicked']);
                CsvUtil.addToTemp(translations['dashboard.table.n_purchases']);
                CsvUtil.addToTemp(translations['n_unique_users_by_purchase']);
                CsvUtil.addToTemp(translations['cr']);
                CsvUtil.addToTemp(translations['dashboard.table.payout_vs_purchases']);
                CsvUtil.addToTemp(translations['dashboard.table.payout_vs_transactions']);
                CsvUtil.addToTemp(translations['dashboard.table.total']);
                CsvUtil.addToTemp(translations['dashboard.table.game_total']);

                CsvUtil.insertTextAndCleanTemp();

                angular.forEach($scope.tableReview, function(date) {

                    angular.forEach(date.apps, function(app) {

                        angular.forEach(app.countries, function(country) {

                            if ($scope.showPayMethods)
                            {
                                angular.forEach(country.pay_methods, function(pay_method) {
                                    CsvUtil.addToTemp(date.date);
                                    CsvUtil.addToTemp(app.name);
                                    CsvUtil.addToTemp(country.country_name || 'Unknown');
                                    CsvUtil.addToTemp(pay_method.name || '-');
                                    CsvUtil.addToTemp($rootScope.currency.symbol);
                                    CsvUtil.addToTemp(pay_method.n_transactions, 'num');
                                    CsvUtil.addToTemp(pay_method.n_unique_users, 'num');
                                    CsvUtil.addToTemp(pay_method.n_clicked, 'num');
                                    CsvUtil.addToTemp(pay_method.n_purchases, 'num');
                                    CsvUtil.addToTemp(pay_method.cr, '%');
                                    CsvUtil.addToTemp(pay_method.payout_vs_purchases, 'num');
                                    CsvUtil.addToTemp(pay_method.payout_vs_transactions, 'num');
                                    CsvUtil.addToTemp(pay_method.amount_total, 'num');
                                    CsvUtil.addToTemp(pay_method.amount_game, 'num');
                                    CsvUtil.addToTemp(pay_method.n_unique_users_by_purchase, 'num');

                                    CsvUtil.insertTextAndCleanTemp();

                                });
                            }else{

                                CsvUtil.addToTemp(date.date);
                                CsvUtil.addToTemp(app.name);
                                CsvUtil.addToTemp(country.country_name || 'Unknown');
                                CsvUtil.addToTemp($rootScope.currency.symbol);
                                CsvUtil.addToTemp(country.n_transactions, 'num');
                                CsvUtil.addToTemp(country.n_unique_users, 'num');
                                CsvUtil.addToTemp(country.n_clicked, 'num');
                                CsvUtil.addToTemp(country.n_purchases, 'num');
                                CsvUtil.addToTemp(country.n_unique_users_by_purchase, 'num');
                                CsvUtil.addToTemp(country.cr, '%');
                                CsvUtil.addToTemp(country.payout_vs_purchases, 'num');
                                CsvUtil.addToTemp(country.payout_vs_transactions, 'num');
                                CsvUtil.addToTemp(country.amount_total, 'num');
                                CsvUtil.addToTemp(country.amount_game, 'num');

                                CsvUtil.insertTextAndCleanTemp();
                            }
                        });
                    });

                });

                CsvUtil.downloadAndReset('summary.csv');
            });
        };

        function calculateEspecialOperations(obj)
        {
            obj.cr= obj.n_purchases / obj.n_transactions * 100;
            obj.payout_vs_purchases= obj.n_purchases ? obj.amount_game / obj.n_purchases : null;
            obj.payout_vs_transactions= obj.n_transactions ? obj.amount_game / obj.n_transactions : null;
        }

    function sum(obj, valuesObj)
    {
        obj.n_unique_users += valuesObj.n_unique_users;
        obj.n_transactions+= valuesObj.n_transactions;
        obj.n_clicked+= valuesObj.n_clicked;
        obj.n_purchases+= valuesObj.n_purchases;
        obj.amount_total+= valuesObj.amount_total;
        obj.amount_game+= valuesObj.amount_game;
        obj.n_unique_users_by_purchase+= valuesObj.n_unique_users_by_purchase;
    }


    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
//        $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
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

    exe();
}]);