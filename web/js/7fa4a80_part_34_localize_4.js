smartApp.filter('localize', ['localize', function(localize) {
    return function(text, input) {

        return localize.localizeText(text);
    }
}]);