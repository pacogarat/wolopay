smartApp.directive('countryFlag', ['$compile', function ($compile) {

    return {
        restrict: 'AE',
        link: function(scope, element, attrs) {

            var country_id = attrs.state.toLowerCase();
            var country_name = attrs.name;

            element.html('<span data-tooltip="{[{\''+country_name+'\' }]}" style="text-align:center;"><img src="/img/1x1.png" class="flag flag-' + country_id + '" alt="' +country_name+ '" /></span>');
            $compile(element.contents())(scope);
        }
    };
}]);