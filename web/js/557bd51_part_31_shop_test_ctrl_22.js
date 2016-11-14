smartApp.controller('ShopTestCtrl', [ '$rootScope', '$location', '$scope', '$timeout', 'APILanguages', 'APICountries', 'APIAppShops', 'APIAppTabs', 'APIArticles', 'APIGamers',
    function ($rootScope, $location, $scope, $timeout, APILanguages, APICountries, APIAppShops, APIAppTabs, APIArticles, APIGamers) {

        $rootScope.topBoxSelectors = false;

        var date = new Date();
        $scope.petitions = {gamer_id: null};


        $scope.$on("$destroy", function() {
            delete $rootScope.configuratorCurrent;
            $rootScope.topBoxSelectors = true;
        });

        $scope.loadIframe = function(width){

            if (!$scope.formValid())
                return;

            width = width || '100%';
            $('#shop_test_iframe').attr('src', 'about:blank');
            $timeout(function(){
                $('#shop_test').width(width);
            }, 50);
        };

        $scope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;
            exe();
        });

        function exe(){

            APIAppShops.getByAppId($rootScope.app.id).success(function(data){
                $scope.shops = data;
            });

            $scope.formValid = function()
            {
                if (!$scope.add_external_user_id)
                    return false;

                var result = true;

                angular.forEach($scope.gamersIgnored, function(gamer, index) {
                    if (gamer.gamer_external_id == $scope.add_external_user_id)
                        result = false;
                });

                return result;
            };

            $scope.calculateArticles = function()
            {
                if ($scope.advanced_options)
                {
                    APIArticles.getByFilters($rootScope.app.id, $scope.petitions.selected_tab, $scope.petitions.country, $scope.petitions.level_category_id, null ).success(function(data){
                        $scope.articles = data;
                    });

                    APILanguages.getAll($rootScope.app.id).success(function(data){
                        $scope.languages = data;
                    });

                    APIAppTabs.getByAppId($rootScope.app.id).success(function(data){
                        $scope.tabs = data;
                    });

                    APICountries.getByAppId($rootScope.app.id).success(function(data){
                        $scope.countries = data;
                    });
                }

            };

            $scope.calculateArticles();

            APIGamers.getByAppIdForTesting($rootScope.app.id).success(function(data){

                if (data.length > 0)
                    $scope.petitions.gamer_id = data[0].gamer_external_id;
                else
                {
                    $scope.setForTest(true, 'TEST');
                    $scope.petitions.gamer_id = 'TEST';
                }

                $scope.gamersIgnored = data;
            });
        }

        $scope.send = function()
        {
            $('#shop_test_iframe').removeAttr('srcdoc');
            $timeout(function(){
                $('#shop_test_iframe').attr('src', '/admin/load/shop/test/' + $rootScope.app.id+'?t='+Math.random()+
                    '&gamer_id='+$scope.petitions.gamer_id+'&level_category_id='+ $scope.petitions.level_category_id +'&country='+
                    ($scope.petitions.country || '') +'&language='+($scope.petitions.language || '') + '&selected_tab_category_id='+($scope.petitions.selected_tab || '')+
                    '&selected_article_id='+($scope.petitions.selected_article || '')
                );
            }, 100);

        };

        $scope.setForTest = function(state, externalGamerId)
        {
            APIGamers.setGamerForTesting(externalGamerId, $rootScope.app.id, state).success(function(data){
                if (state)
                    $scope.gamersIgnored.push(data);
                else
                {
                    angular.forEach($scope.gamersIgnored, function(gamer, index) {
                        if (gamer.gamer_external_id == externalGamerId)
                            $scope.gamersIgnored.splice(index, 1);
                    });
                }
            });
        };

        exe();
}]);

