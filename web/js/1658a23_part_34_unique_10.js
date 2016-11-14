smartApp.filter('unique', function () {

    return function (items, filterOn) {

        if (filterOn === false) {
            return items;
        }

        if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {

            var hashCheck = {}, newItems = [];

            var extractValueToCompare = function (item) {

                if (angular.isObject(item) && angular.isString(filterOn)) {
                    var values = filterOn.split("."), temp=angular.copy(item);

                    angular.forEach(values, function (val) {
                        if (temp === undefined || temp[val] === undefined)
                        {
                            console.log(temp[val], "REMOVED2");
                            temp = undefined;
                        }
                        else
                            temp=temp[val];
                    });

                    if (temp === undefined)
                    {
                        console.log(temp, "REMOVED");
                        temp = null;
                    }

                    return temp;
                } else {

                    return item;
                }
            };


            angular.forEach(items, function (item) {
                var valueToCheck, isDuplicate = false;

                var value2 = extractValueToCompare(item);
                console.log("value2", value2);

                for (var i = 0; i < newItems.length; i++) {

                    var value1 = extractValueToCompare(newItems[i]);
                    console.log("value1", value1);

                    if (angular.equals(value1, value2)) {
                        console.log();
                        isDuplicate = true;
                        break;
                    }
                }

                if (!isDuplicate && value2!==undefined) {
                    newItems.push(item);
                }

            });
            items = newItems;
        }
        return items;
    };
});