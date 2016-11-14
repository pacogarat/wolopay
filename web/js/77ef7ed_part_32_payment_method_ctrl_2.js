smartApp.controller('PaymentMethodController', ['APIStats', '$scope', '$rootScope', '$log', 'Sparkline', 'Flot', 'localize', '$timeout',
    function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, localize, $timeout) {

        $scope.reverse = true;
        $scope.reverseAll = true;
        $scope.predicate = '';
        $scope.predicateAll = 'amount_game';

        $scope.eyeSlash = function(payMethod)
        {
            if(!payMethod.onlyMe){
                payMethod.onlyMe=true;
                $scope.chartOnlyShowSerie(payMethod.pay_method);
            }else{
                payMethod.onlyMe=false;
                $scope.chartShowAll();
            }
        };

        // Created to execute before loading than render table
        $scope.changeCountryEnabledCopy = function (changeCountryEnabledCopy)
        {
            $scope.loading = true;
            $timeout(function(){$scope.countryEnabled = changeCountryEnabledCopy}, 50);
        };

        $scope.chartOnlyShowSerie = function(serieName)
        {
            var series = $('#flotcontainer_payment_methods_1').highcharts().series;

            angular.forEach(series, function(serie, index) {
                serie.setVisible(serie.options.name_custom == serieName);
            });
        };

        $scope.chartShowAll = function()
        {
            var series = $('#flotcontainer_payment_methods_1').highcharts().series;

            angular.forEach(series, function(serie, index) {
                serie.setVisible(true);
            });
        };

        $scope.chartHideShowSerie = function(serieName){
            var series = $('#flotcontainer_payment_methods_1').highcharts().series;

            angular.forEach(series, function(serie, index) {

                if (serie.options.name_custom == serieName )
                {
                    serie.setVisible(!series[index].visible);
                }

                angular.forEach(serie.data, function(data, index) {
                    if (data.name_custom == serieName )
                    {
                        data.setVisible(!data.visible);
                    }
                });

            });

        };


        $scope.orderBy = function(field, suffix){

            suffix = suffix || '';

            if (field == $scope['predicate'+suffix])
                $scope['reverse'+suffix] = !$scope['reverse'+suffix];

            $scope['predicate'+suffix] = field;

        };

        $scope.collapse = function(date_format, collapse){
            angular.forEach($scope.table, function(collection) {
                if (date_format == 'ALL' || collection.date_format == date_format)
                    collection.collapsed = collapse;
            });
        };

        $scope.collapseWithCountry = function(collapse){
            angular.forEach($scope.tableAllWithCountry, function(collection) {
                collection.collapsed = collapse;
            });
        };

        $scope.formatTable = function(table){
            var result = [], previousDateFormat = '', lastGroup;
            angular.forEach(table, function(collection) {
                if (previousDateFormat != collection.date_format)
                {
                    lastGroup = {
                        group: true,
                        date_format: collection.date_format,
                        amount_total: 0,
                        collapsed: false,
                        amount_provider: 0,
                        amount_wolopay: 0,
                        amount_game: 0,
                        num_transactions: 0,
                        num_purchases: 0,
                        pay_method_attempt: 0
                    };
                    result.push(lastGroup);

                    previousDateFormat = collection.date_format;
                }

                lastGroup['amount_total'] += collection.amount_total;
                lastGroup['amount_provider'] += collection.amount_provider;
                lastGroup['amount_wolopay'] += collection.amount_wolopay;
                lastGroup['amount_game'] += collection.amount_game;
                lastGroup['num_transactions'] += collection.num_transactions;
                lastGroup['num_purchases'] += collection.num_purchases;
                lastGroup['pay_method_attempt'] += collection.pay_method_attempt;

                result.push(collection);
            });

            return result;
        };

        function exe()
        {
            APIStats.getPaymentMethods().success(function (data){

                $scope.dateFormat = data.date_format;

                var xAsis=Flot.getXAxisFormatTime($scope.dateFormat);

                var series = [], i = 0, attemptsBy = {}, revenueBy = {}, temp, memoColor={},
                    tableAllObj = {}, tableAll = [], tableAllWithCountryObj = {}, tableAllWithCountry = []
                ;


                angular.forEach(data.table_all, function(collection) {

                    if (!tableAllWithCountryObj[collection['country']])
                    {
                        tableAllWithCountryObj[collection['country']] = {};
                    }

                    if (!tableAllWithCountryObj[collection['country']][collection['pay_method']])
                    {
                        tableAllWithCountryObj[collection['country']][collection['pay_method']] = {
                            pay_method: collection['pay_method'],
                            country: collection['country'],
                            amount_total: 0,
                            amount_provider: 0,
                            amount_wolopay: 0,
                            amount_game: 0,
                            amount_game_evolution: [],
                            amount_game_evolution_obj: {},
                            num_transactions: 0,
                            num_purchases: 0,
                            num_purchases_evolution: [],
                            num_purchases_evolution_obj: {},
                            pay_method_attempt: 0,
                            pay_method_attempt_evolution: [],
                            pay_method_attempt_evolution_obj: {}
                        };
                    }

                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_total'] += collection.amount_total;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_provider'] += collection.amount_provider;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_wolopay'] += collection.amount_wolopay;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_game'] += collection.amount_game;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['num_transactions'] += collection.num_transactions;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['num_purchases'] += collection.num_purchases;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['pay_method_attempt'] += collection.pay_method_attempt;

                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_total_avg'] = collection['num_purchases'] == 0 ? 0 : collection['amount_total'] / collection['num_purchases'];
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_game_avg'] = collection['num_purchases'] == 0 ? 0 :collection['amount_game'] / collection['num_purchases'];
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['purchases_vs_attempt'] = collection['pay_method_attempt'] == 0 ? 0 : collection['num_purchases'] / collection['pay_method_attempt'] * 100;

                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['pay_method_attempt_evolution'].push([collection.date_format, collection.pay_method_attempt]);
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['num_purchases_evolution'].push([collection.date_format, collection.num_purchases]);
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_game_evolution'].push([collection.date_format, collection.amount_game]);

                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['pay_method_attempt_evolution_obj'][collection.date_format] = collection.pay_method_attempt;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['num_purchases_evolution_obj'][collection.date_format] = collection.num_purchases;
                    tableAllWithCountryObj[collection['country']][collection['pay_method']]['amount_game_evolution_obj'][collection.date_format] = collection.amount_game;
                });

                function sumIfExist(obj, key, subkey, value)
                {
                    if (obj[key][subkey])
                        obj[key][subkey] += value;
                    else
                        obj[key][subkey] = value;
                }


                angular.forEach(data.table_all, function(collection) {

                    if (!tableAllObj[collection['pay_method']])
                    {
                        tableAllObj[collection['pay_method']] = {
                            pay_method: collection['pay_method'],
                            amount_total: 0,
                            amount_provider: 0,
                            amount_wolopay: 0,
                            amount_game: 0,
                            amount_game_evolution: {},
                            num_transactions: 0,
                            num_purchases: 0,
                            num_purchases_evolution: {},
                            pay_method_attempt: 0,
                            pay_method_attempt_evolution: {}
                        };
                    }

                    tableAllObj[collection['pay_method']]['amount_total'] += collection.amount_total;
                    tableAllObj[collection['pay_method']]['amount_provider'] += collection.amount_provider;
                    tableAllObj[collection['pay_method']]['amount_wolopay'] += collection.amount_wolopay;
                    tableAllObj[collection['pay_method']]['amount_game'] += collection.amount_game;

                    tableAllObj[collection['pay_method']]['num_transactions'] += collection.num_transactions;
                    tableAllObj[collection['pay_method']]['num_purchases'] += collection.num_purchases;
                    tableAllObj[collection['pay_method']]['pay_method_attempt'] += collection.pay_method_attempt;

                    sumIfExist(tableAllObj[collection['pay_method']], 'amount_game_evolution', collection.date_format, collection.amount_game);
                    sumIfExist(tableAllObj[collection['pay_method']], 'pay_method_attempt_evolution', collection.date_format, collection.pay_method_attempt);
                    sumIfExist(tableAllObj[collection['pay_method']], 'num_purchases_evolution', collection.date_format, collection.num_purchases);

                });

                angular.forEach(tableAllObj, function(collection, index) {
                    tableAllObj[index]['amount_total_avg'] = collection['num_purchases'] == 0 ? 0 : collection['amount_total'] / collection['num_purchases'];
                    tableAllObj[index]['amount_game_avg'] = collection['num_purchases'] == 0 ? 0 :collection['amount_game'] / collection['num_purchases'];
                    tableAllObj[index]['purchases_vs_attempt'] = collection['pay_method_attempt'] == 0 ? 0 : collection['num_purchases'] / collection['pay_method_attempt'] * 100;

                    collection.amount_game_evolution = Flot.parseArrayKeyText(collection.amount_game_evolution);
                    collection.pay_method_attempt_evolution = Flot.parseArrayKeyText(collection.pay_method_attempt_evolution);
                    collection.num_purchases_evolution = Flot.parseArrayKeyText(collection.num_purchases_evolution);
                });

                angular.forEach(tableAllObj, function(collection) {
                    tableAll.push(collection);
                });

                angular.forEach(tableAllWithCountryObj, function(collec, country) {
                    temp = [];
                    var objectSUM = {
                        country: country,
                        collapsed: true,
                        amount_total: 0,
                        amount_provider: 0,
                        amount_wolopay: 0,
                        amount_game: 0,
                        amount_game_evolution: {},
                        num_transactions: 0,
                        num_purchases: 0,
                        num_purchases_evolution: {},
                        pay_method_attempt: 0,
                        pay_method_attempt_evolution: {}
                    };

                    angular.forEach(collec, function(collection) {
                        temp.push(collection);

                        objectSUM['amount_total'] += collection.amount_total;
                        objectSUM['amount_provider'] += collection.amount_provider;
                        objectSUM['amount_wolopay'] += collection.amount_wolopay;
                        objectSUM['amount_game'] += collection.amount_game;
                        objectSUM['num_transactions'] += collection.num_transactions;
                        objectSUM['num_purchases'] += collection.num_purchases;
                        objectSUM['pay_method_attempt'] += collection.pay_method_attempt;

                        angular.forEach(collection.pay_method_attempt_evolution_obj, function(value, date_format) {
                            sumIfExist(objectSUM, 'amount_game_evolution', date_format, value);
                        });
                        angular.forEach(collection.pay_method_attempt_evolution_obj, function(value, date_format) {
                            sumIfExist(objectSUM, 'pay_method_attempt_evolution', date_format, value);
                        });
                        angular.forEach(collection.num_purchases_evolution_obj, function(value, date_format) {
                            sumIfExist(objectSUM, 'num_purchases_evolution', date_format, value);
                        });

                    });

                    objectSUM.pay_methods = temp;

                    objectSUM['amount_total_avg'] = objectSUM['num_purchases'] == 0 ? 0 : objectSUM['amount_total'] / objectSUM['num_purchases'];
                    objectSUM['amount_game_avg'] = objectSUM['num_purchases'] == 0 ? 0 :objectSUM['amount_game'] / objectSUM['num_purchases'];
                    objectSUM['purchases_vs_attempt'] = objectSUM['pay_method_attempt'] == 0 ? 0 : objectSUM['num_purchases'] / objectSUM['pay_method_attempt'] * 100;

                    objectSUM.amount_game_evolution = Flot.parseArrayKeyText(objectSUM.amount_game_evolution);
                    objectSUM.pay_method_attempt_evolution = Flot.parseArrayKeyText(objectSUM.pay_method_attempt_evolution);
                    objectSUM.num_purchases_evolution = Flot.parseArrayKeyText(objectSUM.num_purchases_evolution);


                    tableAllWithCountry.push(objectSUM);
                });

                $scope.tableAll = tableAll;
                $scope.tableAllWithCountry = tableAllWithCountry;
                var revenuePieTemp = {}, revenuePie = [];

                angular.forEach(data.table, function(collection) {

                    if (!revenueBy[collection['pay_method']])
                    {
                        revenueBy[collection['pay_method']] = [];
                        revenuePieTemp[collection['pay_method']] = 0;
                        memoColor[collection['pay_method']] = Flot.getColors()[i++];
                        collection['color'] = memoColor[collection['pay_method']];
                    }else{
                        collection['color'] = memoColor[collection['pay_method']];
                    }

                    temp= {};
                    temp[collection['date_format']] = collection['amount_game'];

                    revenueBy[collection['pay_method']].push(temp);
                    revenuePieTemp[collection['pay_method']] += collection['amount_game'];
                });

                i = 0;
                angular.forEach(revenuePieTemp, function(collection, payMethod) {
                    revenuePie.push({
                        name: payMethod,
                        y: Math.round(collection * 100)/100,
                        color: Flot.increaseBrightness(Flot.getColors()[i++], 10),
                        name_custom: payMethod
                    });
                });

                i = 0;

                series.push({
                    type: 'pie',
                    name: localize.localizeText('revenue'),
                    borderColor: "#777777",
                    data: revenuePie,
                    tooltip: { valueSuffix: $rootScope.currency.symbol },
                    center: ["97%", 30],
                    innerSize: '60%',
                    size: 100,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                });
                angular.forEach(revenueBy, function(collection, payMethod) {
                    series.push(
                        {
                            yAxis: 0,
                            type: 'column',
                            borderColor: "#777777",
                            borderWidth: 1,
                            pointRange: Flot.getPointRange($scope.dateFormat),
                            stacking: 'normal',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            name: localize.localizeText('revenue')+' '+payMethod,
                            color: Flot.increaseBrightness(Flot.getColors()[i++], 10),
                            data: Flot.parseArrayKey(collection, $scope.dateFormat),
                            name_custom: payMethod
                        }
                    );
                });

                $scope.table = $scope.formatTable(data.table);
                $scope.collapse('ALL', true);

                $("#flotcontainer_payment_methods_1").highcharts({
                    chart: {
                        zoomType: 'xy'
                    },
                    legend: {
                        enabled: false
                    },
                    title: {
                        text: null
                    },
                    xAxis:
                        xAsis
                    ,
                    yAxis: [ {
                        labels: {
                            enabled: true
                        },
                        title: {
                            text: localize.localizeText('revenue')
                        }
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

        $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
            $scope.loading = false;
        });

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