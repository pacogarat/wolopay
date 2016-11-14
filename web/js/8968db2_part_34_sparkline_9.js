smartApp.factory('Sparkline' , ['$filter', function ($filter) {
    return {
        getCSVFromObject: function (obj){

            var result = '';

            $.each(obj, function(key, value) {
                if (key != 'total')
                    result +=String(value) +',';
            });
            if (result.length> 1)
                result = result.substring(0, result.length -1);

            return result;
        },
        getArrayFromArrayKey: function (obj, maxDataNum){

            maxDataNum = maxDataNum || 8;
            var result = [], i = 0;

            $.each(obj, function(key, value) {
                result.push(Math.round(value* 100) / 100);
                if (i >= maxDataNum)
                    result.shift();
                i++;
            });

            return result;
        }
    };
}]);
smartApp.directive('highSparkline', [ function (){
    'use strict';
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function (scope, elem, attrs, ngModel) {

            var opts={
                chart: {},
                series: [{data: null}],
                tooltip: {
                    headerFormat: '<span style="font-size: 10px">Q {point.key}:</span><br/>'
                }
            };

            var render = function () {

                if(attrs.opts) angular.extend(opts, angular.fromJson(attrs.opts));
                opts.chart.type = attrs.type || 'bar';


                var data=[];

                angular.forEach(ngModel.$viewValue, function(number) {
                    if (Array.isArray(number))
                    {
                        data.push([number[0], Math.round(number[1] * 100)/100]);
                    }else{
                        data.push(Math.round(number * 100)/100);
                    }
                });

                if (data && data.length > 1)
                {
                    opts.series[0].data = data;
                    setTimeout(function(){ $(elem).highcharts('SparkLine', opts)}, 2);
                }

            };

            scope.$watch(attrs.ngModel, function () {
                render();
            });

        }
    }
}]);