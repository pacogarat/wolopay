smartApp.filter('replace_our_vars', ['localize', '$sce', function(localize, $sce) {
    return function(str, number) {
        number = number || 'N#';
        return $sce.trustAsHtml((str.toString() || '').replace('{[{number}]}', number));
    }
}]);