smartApp.controller('ContinentCountriesController', ['APIStats', '$scope', '$rootScope', '$log', 'Sparkline', 'Flot', 'localize', '$timeout',
    function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, localize, $timeout) {

        $scope.collapse = function(date_format, collapse){
            angular.forEach($scope.table, function(collection) {
                if (date_format == 'ALL' || collection.date_format == date_format)
                    collection.collapsed = collapse;
            });
        };

        $scope.eyeSlash = function(country)
        {
            if(!country.onlyMe){
                country.onlyMe=true;
                $scope.chartOnlyShowSerie(country.country_iso);
            }else{
                country.onlyMe=false;
                $scope.chartShowAll();
            }
        };

        $scope.chartOnlyShowSerie = function(serieName)
        {
            var series = $('#flotcontainer_continents_countries_1').highcharts().series;

            angular.forEach(series, function(serie, index) {
                serie.setVisible(serie.options.name_custom == serieName);
            });
        };

        $scope.chartShowAll = function()
        {
            var series = $('#flotcontainer_continents_countries_1').highcharts().series;

            angular.forEach(series, function(serie, index) {
                serie.setVisible(true);
            });
        };

        $scope.chartHideShowSerie = function(serieName){
            var series = $('#flotcontainer_continents_countries_1').highcharts().series;

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


        $scope.loadMap = function ()
        {
            var tempArray, tempMax, i = 0, countryByPurchases = [], countryRevenueByDateFormat = [],
                countryByTransactions = [], countryByTransactionsByDateFormat = [], countryByRevenueByDateFormatMAX = 1,
                countryByTransactionsByDateFormatMAX  = 1;

            var data = $scope.data;

            angular.forEach(data.purchases_and_transactions_full, function(collection) {

                if (!collection.country_iso)
                    return;

                countryByPurchases.push({
                    code: collection.country_iso,
                    z: Math.round(collection.amount_game * 100 ) / 100
                });

                countryByTransactions.push({
                    code: collection.country_iso,
                    value: collection.transactions
                });

                tempArray = Flot.parseArrayKey(collection.amount_game_by_date, 'not_title');
                tempMax = Math.max.apply(null, tempArray);

                if (tempMax > countryByRevenueByDateFormatMAX)
                    countryByRevenueByDateFormatMAX = tempMax;

                countryRevenueByDateFormat.push({
                    code: collection.country_iso,
                    sequence: tempArray,
                    z: Math.round(collection.amount_game * 100 ) / 100
                });

                tempArray = Flot.parseArrayKey(collection.transactions_by_date, 'not_title');
                tempMax = Math.max.apply(null, tempArray);

                if (tempMax > countryByTransactionsByDateFormatMAX)
                    countryByTransactionsByDateFormatMAX = tempMax;

                countryByTransactionsByDateFormat.push({
                    code: collection.country_iso,
                    sequence: tempArray,
                    value: collection.transactions
                });

            });


            if ($scope.showEvolution)
            {
                // MOTION EVOLUTIONNN
                $('#wold_map_over_view').highcharts('Map', {
                    chart : {
                        borderWidth : 0,
                        margin: 0,
                        animation: false
                    },
                    title: {
                        text: null
                    },
                    mapNavigation: {
                        enabled: true,
                        enableMouseWheelZoom: false,
                        buttonOptions: {
                            x: 20,
                            verticalAlign: 'middle'
                        }
                    },
                    colorAxis: {
                        min: 0,
                        max: countryByTransactionsByDateFormatMAX
                    },
                    motion: {
                        enabled: true,
                        axisLabel: 'year',
                        labels: Flot.getKeys(data.purchases_and_transactions_full[Object.keys(data.purchases_and_transactions_full)[0]]['purchase_by_date']),
                        loop: true,
                        series: [0, 1], // The series which holds points to update
                        updateInterval: 65,
                        magnet: {
                            round: 'round', // ceil / floor / round
                            step: 0.1
                        }
                    },
                    series: [{
                        type: "map",
                        data : countryByTransactionsByDateFormat,
                        mapData: Highcharts.maps['custom/world'],
                        joinBy: ['iso-a2', 'code'],
                        name: localize.localizeText('transactions'),
                        states: {
                            hover: {
                                color: '#BADA55'
                            }
                        }
                    }, {
                        data: countryRevenueByDateFormat,
                        mapData: Highcharts.maps['custom/world'],
                        color: '#009933',
                        joinBy: ['iso-a2', 'code'],
                        name: localize.localizeText('revenue'),
                        type: 'mapbubble',
                        zMax: countryByRevenueByDateFormatMAX, // 1000000000
                        zMin: 1,
                        maxSize: "10%",
                        minSize: "0",
                        tooltip: {
                            valueSuffix: $rootScope.currency.symbol
                        }
                    }]
                });
            }else{
                // Static
                $('#wold_map_over_view').highcharts('Map', {
                    chart : {
                        borderWidth : 0,
                        margin: 0,
                        animation: false
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
                            text: localize.localizeText('transactions')
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
                            data : countryByTransactions,
                            mapData: Highcharts.maps['custom/world'],
                            joinBy: ['iso-a2', 'code'],
                            name: localize.localizeText('transactions'),
                            states: {
                                hover: {
                                    color: '#BADA55'
                                }
                            }
                        },
                        {
                            type: 'mapbubble',
                            color: '#009933',
                            name: localize.localizeText('revenue'),
                            mapData: Highcharts.maps['custom/world'],
                            joinBy: ['iso-a2', 'code'],
                            data: countryByPurchases,
                            minSize: 3,
                            maxSize: '10%',
                            zMax: countryByRevenueByDateFormatMAX*2, // 1000000000
                            zMin: 1,
                            tooltip: {
                                valueSuffix: $rootScope.currency.symbol
                            }
                        }]
                });
            }

            $('#wold_map_over_view').highcharts().mapZoom(0.6);
        };

        function exe()
        {
            APIStats.getContinentsCountries().success(function (data){

                $scope.dateFormat = data.date_format;
                $scope.data = data;

                $scope.loadMap();

                var xAsis=Flot.getXAxisFormatTime($scope.dateFormat), revenueCountryGraphic = [], revenueCountryPie = [], i =0;

                angular.forEach(tableObj, function(collection) {
                    table.push(collection);
                });

                $scope.table = table;
                var countryColors = {};

                angular.forEach(data.purchases_and_transactions_full, function(collection) {

                    var name = collection.country_iso || localize.localizeText('unknown'), color = Flot.getColors()[i++];
                    collection.country_iso = collection.country_iso || localize.localizeText('unknown');
                    collection.country = collection.country || localize.localizeText('unknown');
                    countryColors[collection.country_iso] = color;

                    revenueCountryGraphic.push({
                        yAxis: 0,
                        type: 'column',
                        borderColor: "#777777",
                        borderWidth: 1,
                        stacking: 'normal',
                        color: color,
                        data: Flot.parseArrayKey(collection.amount_game_by_date, $scope.dateFormat),
                        name: name,
                        name_custom: name
                    }
                    );

                    revenueCountryPie.push({
                        name: name ,
                        y: Math.round(collection.amount_game * 100)/100,
                        color: color,
                        name_custom: name
                    });

                });


                $("#flotcontainer_continents_countries_1").highcharts({
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
                    yAxis: [{
                        labels: {
                            enabled: true
                        },
                        title: {
                            text: localize.localizeText('revenue')
                        }
                    }],
                    series:
                        revenueCountryGraphic.concat([{
                            type: 'pie',
                            name: localize.localizeText('revenue'),
                            borderColor: "#777777",
                            data: revenueCountryPie,
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            center: ["97%", 30],
                            innerSize: '60%',
                            size: 100,
                            showInLegend: false,
                            dataLabels: {
                                enabled: false
                            }
                        }])

                });

                var tableObj = {}, table = [], lastDate = '';

                angular.forEach(data.purchases_by_country_date, function(collection) {
                    if (collection.date_format != lastDate)
                    {
                        lastDate = collection.date_format;
                        tableObj[lastDate] = {
                            purchases: 0,
                            transactions: 0,
                            cr: 0,
                            amount_total: 0,
                            amount_game: 0,
                            countries: [],
                            collapsed: true,
                            date_format: lastDate
                        }
                    }

                    collection.country_iso = collection.country_iso || localize.localizeText('unknown');
                    collection.country = collection.country || localize.localizeText('unknown');
                    collection.cr = collection.transactions / collection.purchases;
                    collection.color = countryColors[collection.country_iso];

                    tableObj[lastDate].countries.push(collection);
                    tableObj[lastDate]['purchases'] += collection.purchases;
                    tableObj[lastDate]['transactions'] += collection.purchases;
                    tableObj[lastDate]['cr'] += collection.cr;
                    tableObj[lastDate]['amount_game'] += collection.amount_game;
                    tableObj[lastDate]['amount_total'] += collection.amount_total;
                });


                angular.forEach(tableObj, function(collection) {
                    table.push(collection);
                });

                $scope.table = table;
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