smartApp.factory('CommonFTransPurchNot', ['$rootScope', '$timeout', '$translate', function ($rootScope, $timeout, $translate) {

    return {
        removeDateWhenChangeSearch: function (scope) {
            scope.$on("$destroy", function() {
                $rootScope.dateSelector = true;
            });
            scope.$watch('search', function(newValue, oldValue) {
                var containsSomeSearch = false;
                angular.forEach(newValue, function(collection, key) {
                    if (collection && key != 'page')
                        containsSomeSearch = true;
                });

                if (containsSomeSearch)
                    $rootScope.dateSelector = false;
                else
                    $rootScope.dateSelector = true;
            }, true);
        }
    };
}]);