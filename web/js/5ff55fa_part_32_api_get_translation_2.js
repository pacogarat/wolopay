smartApp.filter('api_translation', function(localize, $sce) {
    return function(array) {
        var result;
        angular.forEach(array, function(row, key){

            if (key.indexOf('_'+localize.currentLang.langCode) !== -1)
                result = row;
        });

        return $sce.trustAsHtml(result);
    }
});