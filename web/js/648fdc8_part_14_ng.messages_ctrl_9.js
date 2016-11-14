shopApp.controller('MessagesCtrl', function ($rootScope, $scope, alerts) {

    $scope.removeError = function(item) {
        var index = $rootScope.errors.indexOf(item)
        $rootScope.errors.splice(index, 1);
    };

    $scope.removeWarning = function(item) {
        alerts.removeWarning(item);
    };

    $scope.removeInfo = function(item) {
        var index = $rootScope.infos.indexOf(item)
        $rootScope.infos.splice(index, 1);
    };

});