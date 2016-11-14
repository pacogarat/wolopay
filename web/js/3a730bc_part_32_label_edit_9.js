smartApp.directive('labelEdit', [ '$modal', function($modal) {
    return {
        restrict: 'A',
        replace: false,
        transclude: false,
        scope: {
            label: '=label',
            languages: '=languages',
            ckeditorAvailble: '=ckeditorAvailble'
        },
        link: function(scope, elem, attrs) {

            elem.bind('click', function() {

                var original = scope.label;

                $modal.open({
                    controller: "LocalizationCtrl",
                    templateUrl: '/bundles/app/client_admin/views/partials/localization_generic.html',
                    resolve: {
                        label: function()
                        {
                            if (!scope.label)
                                scope.label = {};

                            return scope.label;
                        },
                        languages: function()
                        {
                            return scope.languages;
                        },
                        original_label: function()
                        {
                            return original;
                        },
                        ckeditor_available: function()
                        {
                            return (scope.ckeditorAvailble);
                        }

                    }
                });
            });
        }
    }
}]);