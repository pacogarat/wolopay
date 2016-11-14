smartApp.directive('tableBelow',['$rootScope', function($rootScope) {
    return {
        restrict: 'E',
        templateUrl: '/bundles/app/client_admin/views/partials/table_below.html?v='+$rootScope.v, // markup for template
        scope: {
            data: '=', // allows data to be passed into directive from controller scope
            noHeader: '='
        }
    };
}]);
