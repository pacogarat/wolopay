smartApp.filter('unique', function () {

    return function (items, filterOn) {

        if (filterOn === false) {
            return items;
        }

        if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {

            var hashCheck = {}, newItems = [];

            var extractValueToCompare = function (item) {

                if (angular.isObject(item) && angular.isString(filterOn)) {
                    var values = filterOn.split("."),temp=angular.copy(item);

                    angular.forEach(values, function (val) {
                        temp=temp[val];
                    });

                    return temp;
                } else {

                    return item;
                }
            };

            angular.forEach(items, function (item) {
                var valueToCheck, isDuplicate = false;

                for (var i = 0; i < newItems.length; i++) {

                    if (angular.equals(extractValueToCompare(newItems[i]), extractValueToCompare(item))) {
                        isDuplicate = true;
                        break;
                    }
                }
                if (!isDuplicate) {
                    newItems.push(item);
                }

            });
            items = newItems;
        }
        return items;
    };
});