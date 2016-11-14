smartApp.filter('numberIfItIsPossible', function($filter) {
    return function(text) {
        if (isNaN(text) || !text)
            return text;
        else
            return $filter('number')(text, 1);
    }
});