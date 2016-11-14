smartApp.factory('Permissions' , ['$rootScope', function ($rootScope) {

    var permissionList;

    return {
        setPermissions: function(permissions) {
            permissionList = permissions;
            $rootScope.$broadcast('permissionsChanged');
        },
        getPermissions: function(){
            return permissionList;
        },
        hasPermission: function (permission){

            if (!permissionList)
                return false;

            permission = permission.trim();
            if (permissionList.indexOf(permission) == -1)
                return false;

            return true;
        }
    };
}]);