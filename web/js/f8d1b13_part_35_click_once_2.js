smartApp.directive('clickOnce', ['$timeout','$translate','$rootScope','$compile', function($timeout,$translate,$rootScope,$compile) {
    $rootScope.loading = false;
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {

            var oldVal = element.html();

            $rootScope.$watch('loading', function(newValue, oldValue) {
                // timeout to not conflict with submit
                $timeout(function () {
                    if (newValue)
                    {
                        element.html($translate('loading'));
                        element.attr('disabled', true);

                    }else{

                        element.html(oldVal);
                        element.attr('disabled', false);
                        $compile(element.contents())(scope);
                    }
                }, 0);
            });



            element.bind('click', function() {
                $rootScope.loading = true;
            });

        }
    };
}]);