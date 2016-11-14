smartApp.filter('localize', ['localize', '$timeout', function(localize, $timeout) {

    function translate(text, input)
    {
        if (localize.loaded)
            return localize.localizeText(text);
    }

    return translate;
}]);