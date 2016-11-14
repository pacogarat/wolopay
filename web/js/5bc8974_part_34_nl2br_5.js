smartApp.filter('nl2br', ['$translate', '$sce', function($translate, $sce) {
    return function(text, input) {
        return $sce.trustAsHtml(text.replace(/(?:\r\n|\r|\n)/g, '<br />'));
    }
}]);