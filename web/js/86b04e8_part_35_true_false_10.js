smartApp.filter('true_false', ['localize', '$sce', function(localize, $sce) {
    return function(text, input) {
        var theme= '<span></span>';

        if (text) {
            if (input=='bootstrap')
                theme = '<span class="label label-success">%n</span>';

            return $sce.trustAsHtml(theme.replace("%n", "&#10004;"));
        }

        if (input=='bootstrap')
            theme = '<span class="label label-danger">%n</span>';

        return $sce.trustAsHtml(theme.replace("%n", localize.localizeText("&#10007;")));
    }
}]);