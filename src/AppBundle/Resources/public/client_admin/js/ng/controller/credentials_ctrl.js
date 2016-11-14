smartApp.controller('CredentialsController', ['$scope', '$rootScope', 'APICredentials', function ($scope, $rootScope, APICredentials) {

    var exe = function exe(){
        APICredentials.getAll().success(function (data){
            $scope.credentials = data;
        });
    };

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, exe);
    });

    $scope.$on("$destroy", function() {
        appWatch();
    });

    exe();
}]);