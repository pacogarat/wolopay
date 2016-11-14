smartApp.controller('LocalizationCtrl', function (label, $scope, $modalInstance, languages, original_label)
{
    $scope.label = angular.copy(label);

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

});

