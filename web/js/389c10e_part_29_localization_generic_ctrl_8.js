smartApp.controller('LocalizationCtrl', ['label', '$scope', '$modalInstance', 'languages', 'original_label', 'ckeditor_available', function (label, $scope, $modalInstance, languages, original_label, ckeditor_available)
{
    $scope.label = angular.copy(label);
    $scope.ckeditorAvailable = ckeditor_available;
    $scope.languages = languages;

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.ok = function () {
        angular.forEach(languages, function(language){
            label['translation_'+ language.id ]= $scope.label['translation_'+ language.id ];
        });

        $modalInstance.dismiss('cancel');
    };

}]);

