smartApp.filter('api_translation', ['$translate', '$sce', function($translate, $sce) {
    return function(array, n_items) {

        var result = '', currentLang = $translate.use();

        if (!array)
            return '';



        if (array['translation_'+currentLang] !== undefined)
            result = array['translation_'+currentLang];
        else if (array['translation_en'] !== undefined)
            result = array['translation_en'];

        if (n_items)
            return $sce.trustAsHtml(result.replace('{[{number}]}', n_items));

        return $sce.trustAsHtml(result);
    }
}]);