smartApp.directive('currency', ['$filter', '$rootScope', function ($filter, $rootScope) {

    return {
        restrict: 'AE',
        scope: {
            currency: '@currency',
            symbol: '@symb'
        },
        link: function(scope, element, attrs) {

            var num = scope.currency;

            if (isNaN(num))
                return;

            var symbol = scope.symbol || $rootScope.currency.symbol;
            var response = $filter('currency')(num, symbol);

            if (num == 0)
                response = '<span>' + response + '</span>';
            else if (num < 0)
                response = '<span style="color: #DC002F">' + response + '</span>';
            else
                response = '<span style="color: #017922">' + response + '</span>';

            element.html(response);
        }
    };
}]);