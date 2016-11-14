smartApp.directive('hasPermission', function(Permissions) {
    return {
        link: function(scope, element, attrs) {

            var value = attrs.hasPermission.trim();
            var notPermissionFlag = value[0] === '!';
            if(notPermissionFlag) {
                value = value.slice(1).trim();
            }

            function toggleVisibilityBasedOnPermission() {

                var hasPermission = Permissions.hasPermission(value);

                if(hasPermission && !notPermissionFlag || !hasPermission && notPermissionFlag)
                    element.show();
                else
                    element.hide();


            }
            toggleVisibilityBasedOnPermission();
            scope.$on('permissionsChanged', toggleVisibilityBasedOnPermission);
        }
    };
});