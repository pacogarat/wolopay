smartApp.controller('ConfiguratorContainerCtrl', [ '$rootScope', 'APIArticles', '$location', '$scope', 'APIApps',
    function ($rootScope, APIArticles, $location, $scope, APIApps) {

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            delete $rootScope.configuratorCurrent;
            $rootScope.topBoxSelectors = true;
        });

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        $scope.goStep = function (step)
        {
            if (step < $rootScope.configuratorCurrent.step || ($rootScope.configuratorCurrent.completed == true && $rootScope.configuratorCurrent.dirty == false) )
                $rootScope.configuratorCurrent.step = step;
        };

        $scope.stepActive = function(step){
            if ($rootScope.configuratorCurrent.step == step)
                return true;

            return false;
        };

        $scope.stepCompleted = function(step){
            if ($rootScope.configuratorCurrent.step != step &&
                ($rootScope.configuratorCurrent.step > step || ($rootScope.configuratorCurrent.completed == true && $rootScope.configuratorCurrent.dirty == false)) )
            {
                return true;
            }

            return false;
        };

        $rootScope.configuratorCurrent = {};

        function exe(){
            APIApps.getIsConfigured($rootScope.app.id).success(function (data){
                if (data.is_configured == false)
                    $rootScope.configuratorCurrent = { step: 1 };
                else
                    $rootScope.configuratorCurrent = { step: 9, completed: true, dirty: false };
            });
        }




        exe();

}]);

