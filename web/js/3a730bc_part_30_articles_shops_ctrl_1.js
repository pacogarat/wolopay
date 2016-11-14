smartApp.controller('ArticlesShopsController', ['APIStats', '$scope', '$rootScope', '$log', 'Sparkline', 'Flot', '$translate', '$timeout', '$filter',
    function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, $translate, $timeout, $filter) {

        $scope.predicate = 'amount_game';
        $scope.reverse=true;
        $scope.orderShops = 'revenue_sum';

        $translate(['revenue', 'transactions', 'unknown'

        ]).then(function(translations){

            $scope.orderBy = function(field){

                if (field == $scope.predicate)
                    $scope.reverse = !$scope.reverse;

                $scope.predicate = field;

            };

            $scope.collapse = function(table, date_format, collapse){
                angular.forEach(table, function(collection) {
                    if (date_format == 'ALL' || collection.date_format == date_format)
                        collection.collapsed = collapse;
                });
            };

            $scope.sliceOnly = function(serieName)
            {
                var pies = ['flotcontainer_shops_pie_only_articles','flotcontainer_shops_pie_only_tabs', 'flotcontainer_shops_pie_only_shops', 'flotcontainer_shops_pie'];

                angular.forEach(pies, function(pie) {
                    var series = $('#'+pie).highcharts().series;

                    angular.forEach(series, function(serie) {
                        angular.forEach(serie.data, function(serie) {
                            if (serie.options.name_custom)
                                serie.slice(serie.options.name_custom == serieName, false);
                        });
                    });

                    $('#'+pie).highcharts().redraw();
                });
            };

            $scope.eyeSlash = function(articleBag, shop_id)
            {
                if(!articleBag.onlyMe){
                    articleBag.onlyMe=true;
                    $scope.chartOnlyShowSerie(articleBag.article.id, shop_id);
                }else{
                    articleBag.onlyMe=false;
                    $scope.chartShowAll(shop_id);
                }
            };

            $scope.chartOnlyShowSerie = function(serieName, shop_id)
            {
                var series = $('#flotcontainer_shops_'+shop_id).highcharts().series;

                angular.forEach(series, function(serie, index) {
                    serie.setVisible(serie.options.name_custom == serieName, false);
                });

                $('#flotcontainer_shops_'+shop_id).highcharts().redraw();
            };

            $scope.chartShowAll = function(shop_id)
            {
                var series = $('#flotcontainer_shops_'+shop_id).highcharts().series;

                angular.forEach(series, function(serie, index) {
                    serie.setVisible(true, false);
                });

                $('#flotcontainer_shops_'+shop_id).highcharts().redraw();
            };

            $scope.chartHideShowSerie = function(serieName, shop_id)
            {
                var series = $('#flotcontainer_shops_'+shop_id).highcharts().series;

                angular.forEach(series, function(serie, index) {

                    if (serie.options.name_custom == serieName )
                    {
                        serie.setVisible(!series[index].visible, false);
                    }

                    angular.forEach(serie.data, function(data, index) {
                        if (data.name_custom == serieName )
                        {
                            data.setVisible(!data.visible, false);
                        }
                    });

                });

                $('#flotcontainer_shops_'+shop_id).highcharts().redraw();
            };


            var exe = function exe()
            {
                APIStats.getArticlesShops().success(function (data){

                    $scope.dateFormat = data.date_format;
                    $scope.data = data;

                    var xAsis=Flot.getXAxisFormatTime($scope.dateFormat), pieDrillDownObj = {}, shopsObj = {}, shopsPie=[],
                        tabsPie = [], articlesPie = [], onlyArticlesPie = [], onlyArticlesPieObj = {},
                        onlyTabsPie = [], onlyTabsPieObj = {},
                        onlyShopsPie = [], onlyShopsPieObj = {},
                        colors = Flot.getColors(), total= 0, i =0;


                    angular.forEach(data.articles_by_shops_by_tabs, function(collection) {
                        total+= collection.amount_game;
                        if (!onlyArticlesPieObj[collection.article.id])
                        {
                            onlyArticlesPieObj[collection.article.id] = {
                                amount_game: 0,
                                id: collection.article.id,
                                name: $filter('api_translation')(collection.article.name_label, collection.article.items_quantity),
                                color: collection.article.color
                            };
                        }
                        onlyArticlesPieObj[collection.article.id].amount_game += collection.amount_game;

                        if (!onlyTabsPieObj[collection.tab_name])
                        {
                            onlyTabsPieObj[collection.tab_name] = {
                                amount_game: 0,
                                id: collection.tab_name,
                                name: collection.tab_name,
                                color: colors[i++]
                            };
                        }
                        onlyTabsPieObj[collection.tab_name].amount_game += collection.amount_game;

                        if (!pieDrillDownObj[collection.name])
                        {
                            pieDrillDownObj[collection.name] = {
                                amount_game : 0,
                                color : colors[i++],
                                tabs: {}
                            }
                        }
                        if (!onlyShopsPieObj[collection.name])
                        {
                            onlyShopsPieObj[collection.name] = {
                                amount_game: 0,
                                id: collection.name,
                                name: collection.name,
                                color: pieDrillDownObj[collection.name].color
                            };
                        }
                        onlyShopsPieObj[collection.name].amount_game += collection.amount_game;

                        pieDrillDownObj[collection.name].amount_game += collection.amount_game;

                        if (!pieDrillDownObj[collection.name].tabs[collection.tab_name])
                        {
                            pieDrillDownObj[collection.name].tabs[collection.tab_name] = {
                                amount_game : 0,
                                articles: []
                            }
                        }

                        pieDrillDownObj[collection.name].tabs[collection.tab_name].amount_game += collection.amount_game;

                        pieDrillDownObj[collection.name].tabs[collection.tab_name].articles.push(
                            {amount_game: collection.amount_game, id: collection.article.id, name: $filter('api_translation')(collection.article.name_label, collection.article.items_quantity)}
                        );
                    });

                    // order
                    angular.forEach(pieDrillDownObj, function(shop, shopName) {
                        angular.forEach(shop.tabs, function(tab, tabName) {
                            Flot.sortDataPieCharts(tab.articles, 'amount_game');
                        });
                    });

                    angular.forEach(onlyArticlesPieObj, function(article) {
                        if (article.amount_game > 0)
                            onlyArticlesPie.push({y: Math.round(article.amount_game* 100) / 100, name: article.name + ': '+ Math.round((article.amount_game/total)* 10000) /100  +'%', name_custom: article.id, color: Flot.increaseBrightness(article.color, 15)});
                    });

                    angular.forEach(onlyTabsPieObj, function(tab) {
                        if (tab.amount_game > 0)
                            onlyTabsPie.push({y: Math.round(tab.amount_game* 100) / 100, name: tab.name + ': '+ Math.round((tab.amount_game/total)* 10000) /100  +'%', name_custom: tab.name, color: tab.color});
                    });

                    angular.forEach(onlyShopsPieObj, function(shop) {
                        if (shop.amount_game > 0)
                            onlyShopsPie.push({y: Math.round(shop.amount_game* 100) / 100, name: shop.name  + ': '+ Math.round((shop.amount_game/total)* 10000) /100  +'%', name_custom: shop.name, color: shop.color});
                    });

                    angular.forEach(pieDrillDownObj, function(shop, shopName) {

                        if (shop.amount_game>0)
                        {
                            shopsPie.push({y: Math.round(shop.amount_game* 100) / 100, name: shopName, name_custom: shopName, color: shop.color});

                                angular.forEach(shop.tabs, function(tab, tabName) {
                                    if (tab.amount_game > 0)
                                    {
                                        tabsPie.push({y: Math.round(tab.amount_game* 100) / 100, name: tabName,name_custom: tabName, color: Flot.increaseBrightness(shop.color, 30)});
                                        angular.forEach(tab.articles, function(article) {
                                            if (article.amount_game>0)
                                            {
                                                articlesPie.push({y: Math.round(article.amount_game* 100) / 100, name: article.name, name_custom: article.id, color: Flot.increaseBrightness(shop.color, 60)});
                                            }
                                        });
                                    }
                                });

                        }

                    });

                    $('#flotcontainer_shops_pie_only_articles').highcharts({
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: null
                        },
                        yAxis: {
                            title: {
                                text: null
                            }
                        },
                        plotOptions: {
                            pie: {
                                shadow: false,
                                center: ['50%', '50%']
                            }
                        },

                        series: [{
                            name: translations.revenue,
                            data: Flot.sortDataPieCharts(onlyArticlesPie),
                            allowPointSelect: true,
                            borderColor: "#666666",
                            innerSize: '60%',
                            slicedOffset: 20,
                            size: '85%',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            events: {
                                click: function(event)
                                {
                                    $scope.sliceOnly(event.point.name_custom);
                                }
                            }
                        }
                    ]});

                    $('#flotcontainer_shops_pie_only_tabs').highcharts({
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: null
                        },
                        yAxis: {
                            title: {
                                text: null
                            }
                        },
                        plotOptions: {
                            pie: {
                                shadow: false,
                                center: ['50%', '50%']
                            }
                        },

                        series: [{
                            name: translations.revenue,
                            data: Flot.sortDataPieCharts(onlyTabsPie),
                            allowPointSelect: true,
                            borderColor: "#666666",
                            innerSize: '60%',
                            slicedOffset: 20,
                            size: '85%',
                            tooltip: { valueSuffix: $rootScope.currency.symbol},
                            events: {
                                click: function(event)
                                {
                                    $scope.sliceOnly(event.point.name_custom);
                                }
                            }
                        }]
                    });

                    $('#flotcontainer_shops_pie_only_shops').highcharts({
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: null
                        },
                        yAxis: {
                            title: {
                                text: null
                            }
                        },
                        plotOptions: {
                            pie: {
                                shadow: false,
                                center: ['50%', '50%']
                            }
                        },

                        series: [{
                            name: translations.revenue,
                            data: Flot.sortDataPieCharts(onlyShopsPie),
                            allowPointSelect: true,
                            borderColor: "#666666",
                            innerSize: '60%',
                            slicedOffset: 20,
                            size: '85%',
                            tooltip: { valueSuffix: $rootScope.currency.symbol },
                            events: {
                                click: function(event)
                                {
                                    $scope.sliceOnly(event.point.name_custom);
                                }
                            }
                        }]
                    });

                    $('#flotcontainer_shops_pie').highcharts({
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: null
                        },
                        yAxis: {
                            title: {
                                text: 'Total percent market share'
                            }
                        },
                        plotOptions: {
                            pie: {
                                shadow: false,
                                center: ['50%', '50%']
                            }
                        },

                        series: [
                            {
                                name: translations.revenue,
                                data: shopsPie,
                                allowPointSelect: true,
                                borderColor: "#888888",
                                size: '20%',
                                tooltip: { valueSuffix: $rootScope.currency.symbol },
                                dataLabels: {
//                                   color: 'white',
                                   distance: -30
                                },
                                events: {
                                    click: function(event)
                                    {
                                        $scope.sliceOnly(event.point.name_custom);
                                    }
                                }
                            },
                            {
                                name: translations.revenue,
                                data: tabsPie,
                                allowPointSelect: true,
                                borderColor: "#888888",
                                size: '58%',
                                innerSize: '45%',
                                tooltip: { valueSuffix: $rootScope.currency.symbol },
                                dataLabels: {
//                                    color: 'white',
                                    distance: -30
                                },
                                events: {
                                    click: function(event)
                                    {
                                        $scope.sliceOnly(event.point.name_custom);
                                    }
                                }
                            }, {
                                name: translations.revenue,
                                borderColor: "#888888",
                                allowPointSelect: true,
                                tooltip: { valueSuffix: $rootScope.currency.symbol },
                                data: articlesPie,
                                size: '100%',
                                innerSize: '67%',
                                slicedOffset: 20,
                                events: {
                                    click: function(event)
                                    {
                                        $scope.sliceOnly(event.point.name_custom);
                                    }
                                }
                            }]
                    });

                    angular.forEach(data.articles_by_shop_date, function(collection) {

                        if (!collection.shop || !collection.date_format)
                            return;

                        if (!shopsObj[collection.shop])
                        {
                            shopsObj[collection.shop] = {
                                articles: {},
                                name: collection.shop,
                                id: collection.lvl_id,
                                collapsedTable: true,
                                table: {}
                            };
                        }

                        if (!shopsObj[collection.shop].articles[collection.article.id])
                        {
                            shopsObj[collection.shop].articles[collection.article.id] = {
                                revenue_stats: [],
                                unique_users: 0,
                                article: collection.article,
                                revenue_sum: 0
                            };
                        }

                        if (!shopsObj[collection.shop].table[collection.date_format])
                        {
                            shopsObj[collection.shop].table[collection.date_format] = {
                                date_format: collection.date_format,
                                amount_game: 0,
                                unique_users: 0,
                                purchases: 0,
                                amount_total: 0,
                                collapsed: true,
                                data: []
                            };
                        }

                        var temp = {};
                        temp[collection.date_format] = collection.amount_game;
                        collection.avg = collection.amount_game / collection.purchases;
                        shopsObj[collection.shop].articles[collection.article.id].revenue_stats.push(temp);
                        shopsObj[collection.shop].articles[collection.article.id].revenue_sum += collection.amount_game;
                        shopsObj[collection.shop].articles[collection.article.id].unique_users += collection.unique_users;

                        shopsObj[collection.shop].table[collection.date_format]['amount_game'] += collection.amount_game;
                        shopsObj[collection.shop].table[collection.date_format]['purchases'] += collection.purchases;
                        shopsObj[collection.shop].table[collection.date_format]['amount_total'] += collection.amount_total;
                        shopsObj[collection.shop].table[collection.date_format]['unique_users'] += collection.unique_users;

                        shopsObj[collection.shop].table[collection.date_format]['data'].push(collection);
                    });

                    var shops = [], temp = [];

                    angular.forEach(shopsObj, function(collection) {
                        temp = [];
                        angular.forEach(collection.table, function(date) {
                            date.avg = date.amount_game / date.purchases;
                            temp.push(date);
                        });
                        collection.table = temp;

                        shops.push(collection);
                    });

                    $scope.shops = shops;

                    $timeout(function(){

                        var i = 1;

                        angular.forEach(shops, function(shop, shopName) {

                            var series = [], revenuePie = [], name;

                            angular.forEach(shop.articles, function(articleBag) {

                                name = $filter('api_translation')(articleBag.article.name_label, articleBag.article.items_quantity) + ',' + translations.revenue;

                                series.push({
                                    yAxis: 0,
                                    type: 'column',
                                    borderColor: "#777777",
                                    borderWidth: 1,
                                    stacking: 'normal',
                                    tooltip: { valueSuffix: $rootScope.currency.symbol },
                                    pointRange: Flot.getPointRange($scope.dateFormat),
                                    name: name,
                                    color: articleBag.color,
                                    data: Flot.parseArrayKey(articleBag.revenue_stats, $scope.dateFormat),
                                    name_custom: articleBag.article.id
                                });

                                revenuePie.push({
                                    name: name,
                                    y: Math.round(articleBag.revenue_sum * 100)/100,
                                    color: articleBag.color,
                                    name_custom: articleBag.article.id
                                });

                            });


                            $("#flotcontainer_shops_" + shop.id).highcharts({
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
                                        text: translations.revenue
                                    }
                                }],
                                series: series

                            });

                            i++;
                        });

                    }, 100);
                    // end
                });



            };



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

            exe();
        });
}]);