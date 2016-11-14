smartApp.controller('AnalyticsController', function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, localize, Utils) {

    $scope.dateFormat='days';

    $scope.predicate = 'begin_at';
    $scope.reverse=false;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    function exe()
    {

        var colors,
            dataStats = [],
            dateFormat
        ;

        APIStats.getByApp(null, $scope.dateFormat).success(function (data){

            $scope.table = data.purchases_by_country_full;

            if ($scope.dateFormat=='weeks'){
                dateFormat =  '%y-%m-%d W';
            }else if ($scope.dateFormat=='days'){
                dateFormat =  '%y-%m-%d';
            }else{
                dateFormat =  '%y-%m';
            }

            var options = {
                grid: {
                    hoverable: true
                },
                tooltip: true,
//                tooltipOpts: {
//                    dateFormat: dateFormat,
//                    defaultTheme: false
//                },
                shifts: {
                    x: -400,
                    y: 20
                },
                xaxis: {
                    mode: 'time',
                    timeformat: dateFormat
                },
                legend: {
                    show: true,
                    position : "ne", // position of default legend container within plot
                    margin : [0, 10], // distance from grid edge to default legend container within plot
                    backgroundColor : "#efefef", // null means auto-detect
                    backgroundOpacity : 1 // set to 0 to avoid background
                }

            };


            colors = Flot.getColors();
            dataStats=[];


            /* chart colors default */
            var $chrt_border_color = "#efefef";
            var $chrt_grid_color = "#DDD"
            var $chrt_main = "#E24913";			/* red       */
            var $chrt_second = "#6595b4";		/* blue      */
            var $chrt_third = "#FF9F01";		/* orange    */
            var $chrt_fourth = "#7e9d3a";		/* green     */
            var $chrt_fifth = "#BD362F";		/* dark red  */
            var $chrt_mono = "#000";

            $("#flotcontainer_analitycs_1_1").empty();
            $.plot($("#flotcontainer_analitycs_1_1"), [{
                data : Flot.parseArrayKey(data.transactions, $scope.dateFormat),
                label : localize.localizeText('transactions')
            }, {
                data :  Flot.parseArrayKey(data.purchases, $scope.dateFormat),
                label : localize.localizeText('purchases')
            }, {
                data :  Flot.parseArrayKey(data.purchases_without_gifts, $scope.dateFormat),
                label : localize.localizeText('analitycs.purchases_without_gifts')
            }
            ], {
                series : {
                    lines : {
                        show : true,
                        lineWidth : 1,
                        fill : true,
                        fillColor : {
                            colors : [{
                                opacity : 0.1
                            }, {
                                opacity : 0.15
                            }]
                        }
                    },
                    points : {
                        show : true
                    },
                    shadowSize : 0
                },
                xaxis : {
                    mode : "time",
                    timeformat: dateFormat
                },

                grid : {
                    hoverable : true,
                    clickable : true,
                    tickColor : $chrt_border_color,
                    borderWidth : 0,
                    borderColor : $chrt_border_color
                },
                tooltip : true,
                tooltipOpts : {
                    dateFormat : dateFormat,
                    defaultTheme : false,
                    shifts: {
                        x: -100,
                        y: 20
                    }
                },
                colors : [$chrt_main, $chrt_second, $chrt_fourth],
                 legend: {
                    show: true,
                    position : "ne", // position of default legend container within plot
                    margin : [0, 20], // distance from grid edge to default legend container within plot
                    backgroundColor : null, // null means auto-detect
                    backgroundOpacity : 0.8 // set to 0 to avoid background
                }
            });

            // Range
            dataStats=[];

            dataStats.push({label: localize.localizeText('purchases'), data: data.purchases_sum, color: $chrt_second});
            dataStats.push({label: localize.localizeText('analitycs.no_hit'), data: data.transactions_sum - data.purchases_sum, color: '#CCC'});

            createSimplePieChart($('#flotcontainer_analitycs_1_2'), dataStats, null, false);

            dataStats=[];

            dataStats.push({label: localize.localizeText('analitycs.purchases_without_gifts'), data: data.purchases_without_gifts_sum, color: $chrt_fourth});
            dataStats.push({label: localize.localizeText('analitycs.no_hit'), data: data.transactions_sum - data.purchases_without_gifts_sum, color: '#CCC'});

            createSimplePieChart($('#flotcontainer_analitycs_1_3'), dataStats, null, false);

            dataStats=[];

            dataStats.push({label: localize.localizeText('analitycs.unique_users'), data: data.unique_users_sum, color: $chrt_main});
            dataStats.push({label: localize.localizeText('others'), data: data.transactions_sum - data.unique_users_sum, color: '#CCC'});

            createSimplePieChart($('#flotcontainer_analitycs_1_4'), dataStats, null, false);

            // Providers
            createSimplePieChart($('#flotcontainer_analitycs_2'), Flot.parseArrayKeyText(data.providers_pie, 'name', 'num'));
            // Articles
            createSimplePieChart($('#flotcontainer_analitycs_5'), Flot.parseArrayKeyText(data.articles_pie, 'name', 'num'));

            $("#flotcontainer_analitycs_3").empty();
            $.plot($("#flotcontainer_analitycs_3"), [{
                    data :  Flot.parseArrayKey(data.unique_users, $scope.dateFormat),
                    label : localize.localizeText('analitycs.unique_users')
                },
                {
                    data :  Flot.parseArrayKey(data.unique_users_purchases, $scope.dateFormat),
                    label : localize.localizeText('analitycs.unique_users_purchases')
                },
                {
                    data :  Flot.parseArrayKey(data.unique_users_purchases_without_gifts, $scope.dateFormat),
                    label : localize.localizeText('analitycs.unique_users_purchases_without_gifts')
                }
            ], {
                series : {
                    lines : {
                        show : true,
                        lineWidth : 1,
                        fill : true,
                        fillColor : {
                            colors : [{
                                opacity : 0.1
                            }, {
                                opacity : 0.15
                            }]
                        }
                    },
                    points : {
                        show : true
                    },
                    shadowSize : 0
                },
                xaxis : {
                    mode : "time",
                    timeformat: dateFormat
                },

                grid : {
                    hoverable : true,
                    clickable : true,
                    tickColor : $chrt_border_color,
                    borderWidth : 0,
                    borderColor : $chrt_border_color
                },
                tooltip : true,
                tooltipOpts : {
                    dateFormat : dateFormat,
                    defaultTheme : false,
                    shifts: {
                        x: -100,
                        y: 20
                    }
                },
                colors : [$chrt_main, $chrt_second, $chrt_fourth],
                legend: {
                    show: true,
                    position : "ne", // position of default legend container within plot
                    margin : [0, 20], // distance from grid edge to default legend container within plot
                    backgroundColor : null, // null means auto-detect
                    backgroundOpacity : 0.8 // set to 0 to avoid background
                },
                yaxis : {
                    ticks : 15,
                    tickDecimals : 0
                }
            });

        });


    }

    function createSimplePieChart(target, dataCharts, legend, label)
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

    $scope.$watch('dateFormat', function(newValue, oldValue) {
        if (newValue !== oldValue)
            exe();
    });

    $scope.exe = function (){exe();};

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
});