smartApp.filter('nl2br', function(localize, $sce) {
    return function(text, input) {
        return $sce.trustAsHtml(text.replace(/(?:\r\n|\r|\n)/g, '<br />'));
    }
});