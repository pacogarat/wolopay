smartApp.controller('DashboardController', ['$filter', 'APIStats', '$scope', '$rootScope', 'Sparkline', 'Flot', 'localize', 'Utils', '$timeout', 'tableBelow', 'Permissions',
    function ($filter, APIStats, $scope, $rootScope, Sparkline, Flot, localize, Utils, $timeout, tableBelow, Permissions) {

    if (sessionStorage.getItem('firstTimeDashBoard') === null)
    {
        sessionStorage.setItem('firstTimeDashBoard', true);
        $scope.dashboard=false;
        console.log("Hi :)");
    }else{
        $scope.dashboard=null;
    }

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
                $scope.amountsGameSpark = Sparkline.getArrayFromArrayKey(data.amounts_game);
                $scope.transactionsSpark = Sparkline.getArrayFromArrayKey(data.transactions);
                $scope.purchasesSpark = Sparkline.getArrayFromArrayKey(data.purchases);

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

                // amounts
                angular.forEach(data.apps, function(app, key) {
                    appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');

                    var color = app.color;

                    temp.push({title: appName, data: app.amounts_game, color: color});

                    dataStats.push({
                        stack: true,
                        label: appName+", "+localize.localizeText("game_amount"),
                        data:  Flot.parseArrayKey(app.amounts_game, dateFormat),
                        color: color,
                        bars: {
                            show: true,
                            align: "center",
                            barWidth: 30 * 30 * 60 * 1000 * 1,
                            fillColor : {
                                colors : [
                                    { opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5}
                                ]
                            }
                        },

                        group: 'amounts'

                    });
                });

                $scope.gameAmountTable = tableBelow.createObjectByBarChart(temp, true, $rootScope.currency.symbol);

                var options = {

                    grid: {
                        hoverable: true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        dateFormat: '%y-%m-%d',
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: 'time',
                        timeformat: '%y-%m-%d'
                    },
                    legend: {
                        show: false
                    }
                };



                $("#flotcontainer_dashboard_1").empty();
                $.plot($("#flotcontainer_dashboard_1"), dataStats, options);
                dataStats = [];
                temp = [];

                // TRANSACTIONS
                angular.forEach(data.apps, function(app, key) {
                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.transactions, color: app.color});

                    dataStats.push({
                        label: appName+", "+localize.localizeText("transactions"),
                        data:  Flot.parseArrayKey(app.transactions, dateFormat),
                        color: app.color,
                        lines: {
                            show: true,
                            lineWidth: 1
                        },
                        points: {
                            show: true
                        },
                        group: 'transactions'

                    });
                });

                $scope.transactionsTable = tableBelow.createObjectByBarChart(temp, true);

                $("#flotcontainer_dashboard_3").empty();
                $.plot($("#flotcontainer_dashboard_3"), dataStats, options);
                dataStats = [];
                temp = [];

                // PURCHASES
                angular.forEach(data.apps, function(app, key) {

                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.purchases, color: app.color});

                    dataStats.push({

                        label: appName+", "+localize.localizeText("purchases"),
                        data:  Flot.parseArrayKey(app.purchases, dateFormat),
                        color: app.color,
                        lines: {
                            show: true,
                            lineWidth: 1
                        },
                        points: {
                            show: true
                        },
                        group: 'purchases'

                    });
                });

                $scope.purchasesTable = tableBelow.createObjectByBarChart(temp, true);


                $("#flotcontainer_dashboard_4").empty();
                $.plot($("#flotcontainer_dashboard_4"), dataStats, options);
                dataStats = [];
                temp = [];

                // GIFTS
                angular.forEach(data.apps, function(app, key) {

                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.gifts, color: app.color});

                    dataStats.push({

                        label: appName+", "+localize.localizeText("gifts"),
                        data:  Flot.parseArrayKey(app.gifts, dateFormat),
                        color: app.color,
                        lines: {
                            show: true,
                            lineWidth: 1
                        },
                        points : {
                            show : true
                        },
                        group: 'gifts'

                    });
                });

                $scope.giftsTable = tableBelow.createObjectByBarChart(temp, true);

                $("#flotcontainer_dashboard_5").empty();
                $.plot($("#flotcontainer_dashboard_5"), dataStats, options);
                dataStats = [];

                function createSimplePieChart(target, dataCharts)
                {
                    var rect = target.offset();
                    target.empty();
                    $.plot(target, dataCharts, {
                        series : {
                            pie : {
                                show : true,
                                innerRadius : 0.5,
                                radius : 1,
                                label : {
                                    show : true,
                                    radius : 2 / 3,
                                    formatter : function(label, series) {
                                        return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                    },
                                    threshold : 0.1,
                                    background: {
                                        opacity: 0.5
                                    }
                                }
                            }
                        },
                        legend : {
                            show : true,
                            noColumns : 1, // number of colums in legend table
                            labelFormatter : null, // fn: string -> string
                            labelBoxBorderColor : "#000", // border color for the little label boxes
                            container : null, // container (as jQuery object) to put legend in, null means default on top of graph
                            position : "ne", // position of default legend container within plot
                            margin : [5, 10], // distance from grid edge to default legend container within plot
                            backgroundColor : "#efefef", // null means auto-detect
                            backgroundOpacity : 1 // set to 0 to avoid background
                        },
                        grid : {
                            hoverable : true
                        },
                        tooltip: true,
                        tooltipOpts: {
                            content: "%p.0%, %x, %s",
                            shifts: {
                                x: rect.left,
                                y: rect.top
                            },
                            defaultTheme: false
                        }
                    });
                }
                var dataAmountByGame=[];

                angular.forEach(data.apps, function(app, key) {
                    dataAmountByGame.push({label: Utils.findStringById($rootScope.apps, 'id', key, 'name'), data: app.amounts_game_sum, color: app.color})
                });
                createSimplePieChart($('#flotcontainer_dashboard_6'), dataAmountByGame);
                $scope.gameAmountPieTable = tableBelow.createObjectByPieChart(dataAmountByGame, $rootScope.currency.symbol);

    //            createSimplePieChart($('#flotcontainer_dashboard_4'), Flot.parseArrayKeyText(data[$rootScope.app.id].providers_pie, 'name', 'num'));

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

        APIStats.getPayMethods().success(function (data){
            $scope.pay_method_stats = data;
            $scope.pay_method_stats_original = data;
        });
    }

    var tempFilterText = '', filterTextTimeout;
    $scope.searchChange = function (search){

        if (filterTextTimeout)
            $timeout.cancel(filterTextTimeout);

        tempFilterText = search;
        filterTextTimeout = $timeout(function() {
            $scope.pay_method_stats = $filter('filter')($scope.pay_method_stats_original, tempFilterText);
        }, 500);

    };

        var myHeaderCellTemplate = '<div class="ngHeaderSortColumn {[{col.headerClass}]}" ng-style="{\'cursor\': col.cursor}" ng-class="{ \'ngSorted\': !noSortVisible }"><div ng-click="col.sort($event)" ng-class="\'colt\' + col.index" class="ngHeaderText" data-localize="{[{col.displayName}]}"></div><div class="ngSortButtonDown" ng-show="col.showSortButtonDown()"></div><div class="ngSortButtonUp" ng-show="col.showSortButtonUp()"></div><div class="ngSortPriority">{[{col.sortPriority}]}</div><div ng-class="{ ngPinnedIcon: col.pinned, ngUnPinnedIcon: !col.pinned }" ng-click="togglePin(col)" ng-show="col.pinnable"></div></div><div ng-show="col.resizable" class="ngHeaderGrip" ng-click="col.gripClick($event)" ng-mousedown="col.gripOnMouseDown($event)"></div>'

        $scope.gridOptions = {
        data: 'pay_method_stats',
        showGroupPanel: true,
        showColumnMenu: true,
        jqueryUIDraggable: true,
        enableColumnResize: true,
        groupsCollapsedByDefault: true,

        groups: ['my_date', 'app', 'country'],
        aggregateTemplate: '' +
            '<div ng-click="row.toggleExpand()" ng-style="rowStyle(row)" class="ngAggregate ngRow group-depth-{[{row.depth}]}">' +
            '    <span class="ngAggregateText">{[{row.label CUSTOM_FILTERS}]} ({[{row.totalChildren()}]} {[{AggItemsLabel}]})</span>' +
            //'    <div class="ngCell col{[{ 3 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 3 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">≃ {[{aggFunc(row, "n_unique_users") | number }]}</span></div>' +
            '    <div class="ngCell col{[{ 4 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 4 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">≃ {[{aggFunc(row, "n_unique_users") | number }]}</span></div>' +
            '    <div class="ngCell col{[{ 5 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 5 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "n_transactions") | number }]}</span></div>' +
//            '    <div class="ngCell col{[{ 5 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 5 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "n_clicked") | number }]}</span></div>' +
            '    <div class="ngCell col{[{ 6 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 6 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "n_purchases") | number }]}</span></div>' +

            '    <div class="ngCell col{[{ 7 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 7 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFuncAvg(row, "ctr") | percentage }]}</span></div>' +


            '    <div class="ngCell col{[{ 8 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 8 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "total") | currency:currency.symbol }]}</span></div>' +
            '    <div class="ngCell col{[{ 9 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 9 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "game_total") | currency:currency.symbol }]}</span></div>' +

            '    <div class="ngCell col{[{ 10 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 10 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "game_total") / aggFunc(row, "n_purchases") | currency:currency.symbol }]}</span></div>' +
            '    <div class="ngCell col{[{ 11 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 11 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "game_total") / aggFunc(row, "n_transactions") * 1000 | currency:currency.symbol }]}</span></div>' +

            '    <div class="{[{row.aggClass()}]}"></div>' +

            '</div>',
        columnDefs: [
            {field:'my_date', aggLabelFilter: 'localize', displayName: 'Date', headerCellTemplate: myHeaderCellTemplate},
            {field:'app', aggLabelFilter: 'localize', displayName: 'App', headerCellTemplate: myHeaderCellTemplate},
            {field:'country', aggLabelFilter: 'localize', displayName:"Country", headerCellTemplate: myHeaderCellTemplate},
            {field:'pay_method', aggLabelFilter: 'localize', displayName: "Pay Method", headerCellTemplate: myHeaderCellTemplate, groupable: false},
            {field:'n_unique_users', displayName: "dashboard.table.n_unique_users", headerCellTemplate: myHeaderCellTemplate, groupable: false},
            {field:'n_transactions', displayName: "dashboard.table.n_transactions", headerCellTemplate: myHeaderCellTemplate, groupable: false},
//            {field:'n_clicked', displayName: "dashboard.table.n_clicked", headerCellTemplate: myHeaderCellTemplate},

            {field:'n_purchases', displayName: "dashboard.table.n_purchases", headerCellTemplate: myHeaderCellTemplate, groupable: false},
            {field:'ctr', displayName: "dashboard.table.ctr", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'percentage', groupable: false},

            {field:'total', displayName: "dashboard.table.total", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false},
            {field:'game_total', displayName: "dashboard.table.game_total", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false},

            {field:'payout_vs_purchases', displayName: "dashboard.table.payout_vs_purchases", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false},
            {field:'payout_vs_transactions', displayName: "dashboard.table.payout_vs_transactions", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false}

        ]
    };

    $scope.aggFunc = function (row, col) {

        var sumColumn = col;
        var total = 0, temp;
        angular.forEach(row.children, function(entry) {
            temp = parseFloat(entry.entity[sumColumn]);
            if (!isNaN(temp))
                total+= temp ;
        });
        angular.forEach(row.aggChildren, function(entry) {
            total+= parseFloat($scope.aggFunc(entry, col));
        });

        return total;
    };

    $scope.aggFuncAvg = function (row, col) {

        var result = aggFuncAvg(row, col);

        return result.total / result.count;
    };

    function aggFuncAvg(row, col)
    {
        var sumColumn = col;
        var total = 0, temp, result, count = 0;
        angular.forEach(row.children, function(entry) {
            temp = parseFloat(entry.entity[sumColumn]);
            if (!isNaN(temp))
            {
                total+= temp ;
                count++;
            }
        });
        angular.forEach(row.aggChildren, function(entry) {
            result = aggFuncAvg(entry, col);
            total+= parseFloat(result.total);
            count+= result.count;
        });

        return {total: total, count: count};
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