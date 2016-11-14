smartApp.controller('SmartAppController',['$scope', '$rootScope', 'APIRoles', 'Permissions', function ($scope, $rootScope, APIRoles, Permissions) {

    $rootScope.$watch('currency', function(newValue, oldValue) {
        localStorage.setItem('currency-'+$rootScope.usernameId, JSON.stringify(newValue));
    });

    $rootScope.$watch('app', function(newValue, oldValue) {
        if (newValue.id === oldValue.id)
            return false;
        localStorage.setItem('app-'+$rootScope.usernameId, JSON.stringify(newValue));
        APIRoles.getAll().success(function(data){
            Permissions.setPermissions(data)
        });
    });

    $rootScope.$watch('dateQuickSelector', function(newValue, oldValue) {

        if (newValue == oldValue)
            return false;

        var dateFrom = moment();
        var dateTo = moment();

        if (newValue == 1)
            dateTo.subtract(newValue, 'days');

        if (newValue == 1 || newValue == 7 || newValue == 14)
            dateFrom.subtract(newValue, 'days');
        else if (newValue == 30 || newValue == 60 || newValue == 90 || newValue == 180)
            dateFrom.subtract((newValue/30) , 'months');
        else if (newValue == 365)
            dateFrom.subtract(newValue/365, 'years');

        dateFrom.hour($rootScope.dateFrom.getHours());
        dateFrom.minute($rootScope.dateFrom.getMinutes());
        dateFrom.second($rootScope.dateFrom.getSeconds());

        $rootScope.dateFrom = dateFrom.toDate() ;

        dateTo.hour($rootScope.dateTo.getHours());
        dateTo.minute($rootScope.dateTo.getMinutes());
        dateTo.second($rootScope.dateTo.getSeconds());

        $rootScope.dateTo= dateTo.toDate();
    });

    $scope.ignoreNullComparator = function(actual, expected){
        var result=false ;

        if (expected === '' ||  (actual === undefined && typeof expected === 'object' && expected['id'] === '' || expected['name'] === '') )
            return true;

        if (result == false)
            return comparator(actual, expected);

        return result;
    };

    // inside $filter
    var comparator = function(actual, expected) {
        if (!angular.isDefined(actual)) {
            // No substring matching against `undefined`
            return false;
        }
        if ((actual === null) || (expected === null)) {
            // No substring matching against `null`; only match against `null`
            return actual === expected;
        }
        if (typeof expected === 'object' || (typeof expected === 'actual' && !hasCustomToString(actual))) {
            // Should not compare primitives against objects, unless they have custom `toString` method
            return false;
        }

        actual = angular.lowercase('' + actual);
        expected = angular.lowercase('' + expected);
        return actual.indexOf(expected) !== -1;
    };

    function hasCustomToString(obj) {
        return angular.isFunction(obj.toString) && obj.toString !== Object.prototype.toString;
    }
}]);