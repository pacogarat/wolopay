smartApp.directive('tableBelow', function() {
    return {
        restrict: 'E',
        templateUrl: '/bundles/app/client_admin/views/partials/table_below.html?v=', // markup for template
        scope: {
            data: '=', // allows data to be passed into directive from controller scope
            noHeader: '='
        }
    };
});
