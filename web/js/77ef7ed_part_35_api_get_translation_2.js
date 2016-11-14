smartApp.filter('api_translation', ['localize', '$sce', function(localize, $sce) {
    return function(array) {

        var result = '';

        if (!array)
            return '';

        if (array['translation_'+localize.currentLang.langCode] !== undefined)
            result = array['translation_'+localize.currentLang.langCode];
        else if (array['translation_en'] !== undefined)
            result = array['translation_en'];

        return $sce.trustAsHtml(result);
    }
}]);