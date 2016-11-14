smartApp.factory('tableBelow' , ['$filter', function ($filter) {
    return {
        createObjectByBarChart: function (arrObject, dateFormat, suffix){

            suffix = suffix || '';

            var result = [];
            var firstRow = [];

            firstRow.push('');
            angular.forEach(arrObject, function(data) {
                firstRow.push(data.title.toString());
            });

            result.push(firstRow);

            var found = [];

            if (typeof arrObject[0] == 'undefined')
                return result;

            angular.forEach(arrObject[0].data, function(data, key) {
                var temp = [];
                temp.push(key);
                angular.forEach(arrObject, function(app) {
                    angular.forEach(app.data, function(appVal, appRow) {
                        if (key == appRow)
                            temp.push($filter('number')(appVal, 1)+suffix);
                    });
                });
                result.push(temp);
            });

            return result;

        },
        createObjectByPieChart: function (arrObject, suffix){

            var result = [];
            suffix = suffix || '';

            angular.forEach(arrObject, function(value, key) {
                var temp = [];

                temp.push(value.label);
                temp.push($filter('number')(value.data, 1)+suffix);

                result.push(temp);
            });

            return result;

        },
        createObjectByPieChartSimple: function (arrObject){

            var result = [];

            angular.forEach(arrObject, function(value, key) {
                var temp = [];

                temp.push(key);
                temp.push(value);

                result.push(temp);
            });

            return result;
        }
    };
}]);
