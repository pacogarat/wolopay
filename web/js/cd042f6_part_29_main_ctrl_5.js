smartApp
    .controller('PageViewController', ['$scope', '$route', '$animate', '$timeout', function ($scope, $route, $animate, $timeout) {

        $scope.$on('$viewContentLoaded', function(){
            // grid widgets
            $timeout(function(){
                pageSetUp();
            }, 500)

        });

    }])
    .controller('SmartAppController',['$scope', '$rootScope', 'APIRoles', 'Permissions', '$route', '$animate', '$timeout', '$log', function ($scope, $rootScope, APIRoles, Permissions, $route, $animate, $timeout, $log) {

        $scope.reloadRoute = function() {
            $animate.enabled(false);
            $route.reload();
            $timeout(function(){ $animate.enabled(true); }, 1000);
        };

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


        $rootScope.running = false;

        $rootScope.watcher = function (newValue, oldValue, callback)
        {
            callback = callback || function(){};

            if (oldValue && newValue!=oldValue)
                callback();
        };

        $rootScope.watcherWithTimeOut = function (newValue, oldValue, callback)
        {
            callback = callback || function(){};

            if (oldValue && newValue!=oldValue)
            {
                if ($rootScope.running == false)
                {
                    $rootScope.running = true;
                    // Prevent JavaScript function from running twice
                    $timeout(function(){

                        callback();
                        $rootScope.running = false;
                    }, 100);
                }
            }
        };

        $rootScope.$watch('dateQuickSelector', function(newValue, oldValue) {

            if (newValue == oldValue || newValue == '-1')
                return false;

            $log.debug('dateQuickSelector', newValue);

            var dateFrom = moment();
            var dateTo = moment();
            dateFrom.tz($rootScope.options.tz);
            dateTo.tz($rootScope.options.tz);

            if (newValue == 1)
                dateTo.subtract(newValue, 'days');

            if (newValue == 1 || newValue == 7 || newValue == 14)
                dateFrom.subtract(newValue, 'days');
            else if (newValue == 30 || newValue == 60 || newValue == 90 || newValue == 180)
                dateFrom.subtract((newValue/30) , 'months');
            else if (newValue == 365)
                dateFrom.subtract(newValue/365, 'years');

            dateFrom.hour(0);
            dateFrom.minute(0);
            dateFrom.second(0);

            $rootScope.dateFrom = dateFrom.toDate() ;

            dateTo.hour(23);
            dateTo.minute(59);
            dateTo.second(59);

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