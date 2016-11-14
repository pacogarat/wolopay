smartApp.directive('labelEditCkEditor', [ '$modal', '$rootScope', function($modal, $rootScope) {
    return {
        restrict: 'A',
        replace: false,
        transclude: false,
        scope: {
            translationObject: '=translationObject',
            language: '=language'
        },
        link: function(scope, elem, attrs) {

            elem.bind('click', function() {

                $modal.open({
                    controller: "LocalizationCkEditorCtrl",
                    templateUrl: '/bundles/app/client_admin/views/partials/ckeditor_generic.html?v='+$rootScope.v,
                    resolve: {
                        translation_object: function()
                        {
                            if (!scope.translationObject)
                            {
                                scope.translationObject = {};
                                scope.translationObject['translation_'+scope.language.id] = '';
                            }

                            return scope.translationObject;
                        },
                        language: function()
                        {
                            return scope.language;
                        },
                        original_translation_object: function()
                        {
                            return scope.translationObject;
                        }

                    }
                });
            });
        }
    }
}]);