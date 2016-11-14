smartApp.filter('true_false', ['$translate', '$sce', function($translate, $sce) {
    return function(text, input) {
        var theme= '<span></span>';

        if (text) {
            if (input=='bootstrap')
                theme = '<span class="label label-success">%n</span>';

            return $sce.trustAsHtml(theme.replace("%n", "&#10004;"));
        }

        if (input=='bootstrap')
            theme = '<span class="label label-danger">%n</span>';

        return $sce.trustAsHtml(theme.replace("%n", $translate("&#10007;")));
    }
}]);