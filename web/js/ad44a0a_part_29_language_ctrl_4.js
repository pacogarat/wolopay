smartApp.controller('LangController', ['$scope', '$translate', '$scope', 'APIClientUser', function ($rootScope, $translate, $scope, APIClientUser) {

    var searchId = 'en';

    if ($rootScope.options.languageDefault)
        searchId = $rootScope.options.languageDefault.id;

    angular.forEach($rootScope.languages, function(language) {
        if (language.id == searchId)
            $rootScope.language = language;
    });

    $scope.setLang = function (lang) {
        $translate.use(lang.id);
        $rootScope.language = lang;
        APIClientUser.setLanguage(lang.id);
    };

}]);
