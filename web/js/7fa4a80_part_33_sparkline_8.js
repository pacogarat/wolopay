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

smartApp.directive('jqSparkline', [function () {
        'use strict';
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, elem, attrs, ngModel) {

                var opts={};

                var opts={
                    type : attrs.type || 'bar',
                    barColor : $(elem).data('sparkline-bar-color') || $(elem).css('color') || '#0000f0',
                    height : '26px',
                    barWidth : 5,
                    barSpacing : 2,
                    stackedBarColor : '#A90329',
                    negBarColor : ["#A90329", "#0099c6", "#98AA56", "#da532c", "#4490B1", "#6E9461", "#990099", "#B4CAD3"],
                    zeroAxis : 'false'
                };

                var render = function () {
                    var model;

                    if(attrs.opts) angular.extend(opts, angular.fromJson(attrs.opts));

                    // Trim trailing comma if we are a string
                    angular.isString(ngModel.$viewValue) ? model = ngModel.$viewValue.replace(/(^,)|(,$)/g, "") : model = ngModel.$viewValue;
                    var data=model;
                    // Make sure we have an array of numbers
//                    angular.isArray(model) ? data = model : data = model.split(',');
                    if (data)
                    {
                        $(elem).sparkline(data, opts);
                    }


                };

                scope.$watch(attrs.ngModel, function () {
                    render();
                });

//                scope.$watch(attrs.opts, function(){
//                        render();
//                    }
//                );

            }
        }
    }]);