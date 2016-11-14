smartApp.controller('ShopTestCtrl', [ '$rootScope', '$location', '$scope', '$timeout',
    function ($rootScope, $location, $scope, $timeout) {

        $rootScope.topBoxSelectors = false;

        var date = new Date();
        $scope.petitions = {gamer_id: 'TEST-'+date.getTime()};


        $scope.$on("$destroy", function() {
            delete $rootScope.configuratorCurrent;
            $rootScope.topBoxSelectors = true;
        });

        $scope.loadIframe = function(width){
            width = width || '100%';
            $('#shop_test_iframe').attr('src', 'about:blank');
            $timeout(function(){
                $('#shop_test').width(width);
            }, 50);
        };

        $scope.send = function()
        {

            $('#shop_test_iframe').removeAttr('srcdoc');
            $timeout(function(){
                $('#shop_test_iframe').attr('src', '/admin/load/shop/test/' + $rootScope.app.id+'?t='+Math.random()+
                    '&gamer_id='+$scope.petitions.gamer_id+'&gamer_level='+$scope.petitions.gamer_level || '' +'&country='+
                    $scope.petitions.country || '' +'&language='+$scope.petitions.language || '');
            }, 100);

        }
}]);

