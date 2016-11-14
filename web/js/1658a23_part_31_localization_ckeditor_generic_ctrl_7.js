smartApp.controller('LocalizationCkEditorCtrl', ['translation_object', 'original_translation_object', 'language', '$scope', '$modalInstance',
    function (translation_object, original_translation_object, language, $scope, $modalInstance)
{
    $scope.text = translation_object['translation_'+language.id];
    $scope.language = language;

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.ok = function () {

        translation_object['translation_'+ language.id ]= $scope.text;
        $modalInstance.dismiss('cancel');
    };

}]);

