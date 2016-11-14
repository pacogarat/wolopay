smartApp.controller('ProjectsListController', function ($scope, APIApps, $rootScope) {

    function exe(){

        $rootScope.dateSelector = false;

        APIApps.getAll().success(function (data){
            $scope.proyect_apps = data;
        });
    }

    exe();

    $scope.$on("$destroy", function() {
        $rootScope.dateSelector = true;
    });


    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl",
            templateUrl: 'myModalContent.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.notifications = [];
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            exe();
        }
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });
});

smartApp.controller('asd', function ($scope, $modalInstance, notification){

    $scope.notification = notification;

});