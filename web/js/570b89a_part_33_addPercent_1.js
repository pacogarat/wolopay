smartApp.filter('percentage', ['$filter', function($filter) {
    return function(input, decimals) {
        decimals = decimals || 2;
        return $filter('number')(input , decimals) + '%';
    }
}]);