smartApp.controller('ConfiguratorSelectLanguageController', function ($scope, APILanguages, $rootScope) {

    $rootScope.$watch('configuratorCurrent', function(newValue, oldValue) {
        setEnglishSelected();
    });

    $rootScope.configuratorCurrent.languages = [];

    APILanguages.getAll().success(function (data){
        $rootScope.configuratorCurrent.languages = data;

        APILanguages.getAll($rootScope.app.id).success(function (data){
            angular.forEach($rootScope.configuratorCurrent.languages, function(lang) {
                angular.forEach(data, function(langSelected) {
                    if (lang.id == langSelected.id)
                        lang.selected = true;
                });
            });
            setEnglishSelected();
        });
    });

    function setEnglishSelected()
    {
        angular.forEach($rootScope.configuratorCurrent.languages, function(value) {
            if (value.id == 'en')
                value.selected = true;
        });
    }

    $scope.someSelected = function () {

        var result = false, englishDisabled=false;

        angular.forEach($rootScope.configuratorCurrent.languages, function(value) {

            if (value.id == 'en' && !value.selected)
                englishDisabled = true;

            if (value.selected)
                result = true;
        });

        return (result && englishDisabled == false);
    };

    $scope.submit = function (){
        var languages = [];
        angular.forEach($rootScope.configuratorCurrent.languages, function(language) {
            if (language.selected)
                languages.push(language.id);
        });

        APILanguages.updateByApp($rootScope.app.id, languages).success(function (data){
            $rootScope.configuratorCurrent.step = 3;
        });
    }
})
;
