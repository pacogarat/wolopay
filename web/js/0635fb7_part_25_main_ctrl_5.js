smartApp.controller('SmartAppController', function ($scope, $rootScope, APIRoles, Permissions) {

    $rootScope.$watch('currency', function(newValue, oldValue) {
        localStorage.setItem('currency-'+$rootScope.usernameId, JSON.stringify(newValue));
    });

    $rootScope.$watch('app', function(newValue, oldValue) {
        if (newValue.id === oldValue.id)
            return false;
        localStorage.setItem('app-'+$rootScope.usernameId, JSON.stringify(newValue));
        APIRoles.getAll().success(function(data){
            Permissions.setPermissions(data)
        });
    });

});