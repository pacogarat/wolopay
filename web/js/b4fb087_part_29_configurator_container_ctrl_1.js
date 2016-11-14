smartApp.controller('ConfiguratorContainerCtrl', function ($rootScope, APIArticles, $location, $scope, APIOffers, Utils,  alerts, localize, $routeParams, $filter) {

    $scope.$on("$destroy", function() {
        delete $rootScope.configuratorCurrent;
    });

    $scope.$watch('app', function(newValue, oldValue) {
        if (newValue===oldValue)
            return;
        exe();
    });

    $rootScope.configuratorCurrent = {};

    function exe(){
        APIArticles.getArticleByAppId($rootScope.app.id).success(function (data){
            if (data.length == 0)
                $rootScope.configuratorCurrent = { step: 1 };
            else
                $rootScope.configuratorCurrent = { step: 9 };
        });
    }


    $scope.goBack = function (step)
    {
        if (step < $rootScope.configuratorCurrent.step)
            $rootScope.configuratorCurrent.step = step;
    };

    exe();

});

