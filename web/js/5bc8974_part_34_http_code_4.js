smartApp.filter('http_code', ['$translate', '$sce', function($translate, $sce) {
    return function(text, input) {
        if (text>=200 &&  text <300) {

            return $sce.trustAsHtml('<span class="label label-success">'+text+'</span>');
        }

        return $sce.trustAsHtml('<span class="label label-danger" data-translate="%s">'+text+'</span>');
    }
}]);