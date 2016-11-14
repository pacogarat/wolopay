smartApp.controller('CredentialsController', function ($scope, $rootScope, APICredentials) {

    function exe(){
        APICredentials.getAll().success(function (data){
            $scope.credentials = data;
        });
    }

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
            exe();
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
    });

    exe();
});