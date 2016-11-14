angular.module('app.controllers', [])
    .controller('PageViewController', ['$scope', '$route', '$animate', function ($scope, $route, $animate) {
        // controler of the dynamically loaded views, for DEMO purposes only.
        /*$scope.$on('$viewContentLoaded', function() {

         });*/
    }])

    .controller('LangController', ['$scope', 'settings', 'localize', function ($scope, settings, localize) {
        $scope.languages = settings.languages;
        $scope.currentLang = settings.currentLang;
        $scope.setLang = function (lang) {
            settings.currentLang = lang;
            $scope.currentLang = lang;
            localize.setLang(lang);
        };

        // set the default language
        $scope.setLang($scope.currentLang);

    }])


;
