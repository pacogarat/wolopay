smartApp.controller('BlackListedGamersCtrl', [ '$rootScope', '$location', '$scope', '$timeout', 'APILanguages', 'APICountries', 'APIAppShops', 'APIAppTabs', 'APIArticles', 'APIGamers',
    function ($rootScope, $location, $scope, $timeout, APILanguages, APICountries, APIAppShops, APIAppTabs, APIArticles, APIGamers) {

        $scope.searchText = {};

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        $scope.formValid = function()
        {
            if (!$scope.add_external_user_id)
                return false;

            var result = true;

            angular.forEach($scope.gamerBlacklisted, function(gamer, index) {
                if (gamer.gamer_external_id == $scope.add_external_user_id)
                    result = false;
            });

            return result;
        };

        $scope.setBlackListed = function(state, externalGamerId)
        {
            APIGamers.setGamerToBlacklisted(externalGamerId, $rootScope.app.id, state).success(function(data){
                if (state)
                    $scope.gamerBlacklisted.push(data);
                else
                {
                    angular.forEach($scope.gamerBlacklisted, function(gamer, index) {
                        if (gamer.gamer_external_id == externalGamerId)
                            $scope.gamerBlacklisted.splice(index, 1);
                    });
                }
            });
        };

        function exe(){

        }

        exe();
}]);

