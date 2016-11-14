angular.module('shopApp').filter('replace', function () {
    return function (text, replace, replaceBy) {
        replaceBy = replaceBy || '';
        return text.replace(replace, replaceBy);
    };
});
