smartApp.filter('percentage', function($filter) {
    return function(input, decimals) {
        decimals = decimals || 2;
        return $filter('number')(input , decimals) + '%';
    }
});