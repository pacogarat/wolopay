smartApp.directive('dialogConfirmation', [ 'dialogs', function(dialogs) {
    return {
        restrict: 'A',
        replace: false,
        transclude: false,
        scope: {
            callback: '&callback'
        },
        link: function(scope, elem, attrs) {

            elem.bind('click', function() {

                var dlg = dialogs.confirm();
                dlg.result.then(function(btn){

                    scope.callback();

                },function(btn){

                });
            });
        }
    }
}]);