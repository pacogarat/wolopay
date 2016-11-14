smartApp.filter('replace_our_vars', ['$translate', '$sce', function($translate, $sce) {
    return function(str, number) {
        number = number || 'N#';
        return $sce.trustAsHtml((str.toString() || '').replace('{[{number}]}', number));
    }
}]);