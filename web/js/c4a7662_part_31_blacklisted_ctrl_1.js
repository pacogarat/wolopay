smartApp.controller('BlackListedCtrl', [ '$rootScope', '$location', '$scope', '$timeout', 'APILanguages', 'APICountries', 'APIAppShops', 'APIAppTabs', 'APIArticles', 'APIGamers',
    function ($rootScope, $location, $scope, $timeout, APILanguages, APICountries, APIAppShops, APIAppTabs, APIArticles, APIGamers) {

        $rootScope.topBoxSelectors = false;
        $scope.section = 'countries';

        $scope.$on("$destroy", function() {
            delete $rootScope.configuratorCurrent;
            $rootScope.topBoxSelectors = true;
        });

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        function exe(){

        }

        exe();
}]);

