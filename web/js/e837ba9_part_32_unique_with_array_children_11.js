smartApp.filter('unique_with_array_children', function () {

    var getObjectsFromArray = function (values, filterOn, objects)
    {
        objects = objects || [];
        var result;

        angular.forEach(values, function (temp)
        {
            result = temp;
            var isArray = false;

            angular.forEach(filterOn, function (val, index)
            {

                if ((result === undefined || result[val] === undefined) && !result instanceof Array)
                {
                    result = undefined;

                }else{

                    if (result instanceof Array)
                    {
                        var removed = JSON.parse(JSON.stringify(filterOn));
                        removed = removed.splice(index);
                        objects = getObjectsFromArray(result,  removed , objects);
                        isArray = true;

                    }else{

                        if (result)
                            result = result[val];

                    }
                }
            });


            if (!isArray && result !== undefined)
            {
                if (result instanceof Array)
                    objects = getObjectsFromArray (result, [], objects);
                else
                    objects.push(result);
            }

        });

        return objects;
    };

    return function (items, filterOn, lastAttribute) {

        if (filterOn === false) {
            return items;
        }

        lastAttribute = lastAttribute || 'id';

        if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {

            var hashCheck = {}, newItems = [];

            var objects = getObjectsFromArray(items, filterOn.split("."));

            angular.forEach(objects, function (object) {

                var value2 = object[lastAttribute],
                    value1,
                    isDuplicate = false
                ;

                for (var i = 0; i < newItems.length; i++) {

                    if (newItems[i] === undefined || newItems[i][lastAttribute] === undefined)
                        value1 = null;
                    else
                        value1 = newItems[i][lastAttribute];

                    if (angular.equals(value1, value2)) {
                        isDuplicate = true;
                        break;
                    }
                }

                if (!isDuplicate && value2) {
                    newItems.push(object);
                }

            });
            items = newItems;
        }

        return items;
    };
});
