smartApp.filter('debug', function() {
    return function(input) {
        if (input === '') return 'empty string';
        return input ? input : ('' + input);
    };
});