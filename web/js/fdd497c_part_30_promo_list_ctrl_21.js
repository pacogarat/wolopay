smartApp.controller('PromoListCtrl', [ '$rootScope', '$scope', 'APIPromo', 'dialogs', '$modal', 'APIArticles',
    function ($rootScope, $scope, APIPromo, dialogs, $modal, APIArticles) {

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            $rootScope.topBoxSelectors = true;
        });

        APIArticles.getByFilters($rootScope.app.id).success(function(data){
            $scope.articles = data;
        });

        $rootScope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;

            exe();
        });

        $scope.createOrUpdatePromo = function (promo, isNew)
        {
            isNew = isNew || false;

            var modalInstance = $modal.open({
                controller: "CreateOrUpdatePromoCtl",
                templateUrl: 'create_or_update_promo.html',
                backdrop: 'static',
                resolve: {
                    promo: function(){
                        return promo;
                    },
                    promos: function(){
                        return $scope.promos;
                    },
                    isNew: function(){
                        return isNew;
                    }
                }
            });
        };

        $scope.createOrUpdatePromoCode = function (promoCode, promo, isNew)
        {
            isNew = isNew || false;

            var modalInstance = $modal.open({
                controller: "CreateOrUpdatePromoCodeCtl",
                templateUrl: 'create_or_update_promo_code.html',
                backdrop: 'static',
                resolve: {
                    promoCode: function(){
                        return promoCode;
                    },
                    promo: function(){
                        return promo;
                    },
                    isNew: function(){
                        return isNew;
                    },
                    articles: function(){
                        return $scope.articles;
                    }
                }
            });
        };

        function exe(){
            APIPromo.getByAppId($rootScope.app.id).success(function (data){

                angular.forEach(data, function(promo) {
                    promo.collapsed = true;
                });

                $scope.promos = data;

            });
        }

        $scope.delete = function (promo) {

            APIPromo.delete($rootScope.app.id, promo.id).success(function (data){
                $scope.promos.splice( $scope.promos.indexOf(promo), 1 );
            });

        };

        exe();

}]).controller('CreateOrUpdatePromoCtl', [ '$rootScope', '$scope', 'APIPromo', 'dialogs', '$modalInstance', 'promo', 'promos', 'isNew',
    function ($rootScope, $scope, APIPromo, dialogs, $modalInstance, promo, promos, isNew) {

        var promoCopy = angular.copy(promo);
        if (promoCopy.begin_at)
            promoCopy.begin_at = moment(promoCopy.begin_at).toDate();

        if (promoCopy.end_at)
            promoCopy.end_at = moment(promoCopy.end_at).toDate();

        $scope.promo = promoCopy;

        $scope.ok = function () {

            if (isNew)
            {
                APIPromo.create($rootScope.app.id,$scope.promo).success(function(data){
                    $scope.promo.id = data.id;
                    $scope.promo.created_at = data.created_at;
                    $scope.promo.times_used = 0;
                    promos.push($scope.promo);

                    $modalInstance.close();
                });

            }else{

                APIPromo.update($rootScope.app.id, $scope.promo.id, $scope.promo).success(function(data){
                    promo.name = $scope.promo.name;
                    promo.n_uses_per_user = $scope.promo.n_uses_per_user;
                    promo.n_total_uses = $scope.promo.n_total_uses;
                    promo.begin_at = $scope.promo.begin_at;
                    promo.end_at = $scope.promo.end_at;

                    $modalInstance.close();
                });
            }

        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]).controller('CreateOrUpdatePromoCodeCtl', [ '$rootScope', '$scope', 'APIPromo', 'dialogs', '$modalInstance', 'promo', 'promoCode', 'isNew', 'articles',
    function ($rootScope, $scope, APIPromo, dialogs, $modalInstance, promo, promoCode, isNew, articles) {

        $scope.articles = articles;

        var promoCodeCopy = angular.copy(promoCode);
        if (promoCodeCopy.begin_at)
            promoCodeCopy.begin_at = moment(promoCodeCopy.begin_at).toDate();

        if (promoCodeCopy.end_at)
            promoCodeCopy.end_at = moment(promoCodeCopy.end_at).toDate();

        $scope.promoCode = promoCodeCopy;

        $scope.ok = function () {

            if (isNew)
            {
                APIPromoCode.create($rootScope.app.id, promo.id, $scope.promoCode).success(function(data){
//                    $scope.promo.id = data.id;
//                    $scope.promo.created_at = data.created_at;
//                    $scope.promo.times_used = 0;
//                    promos.push($scope.promo);

                    $modalInstance.close();
                });

            }else{

                APIPromoCode.update($rootScope.app.id, promo.id, $scope.promoCode.id, $scope.promoCode).success(function(data){
//                    promo.name = $scope.promo.name;
//                    promo.n_uses_per_user = $scope.promo.n_uses_per_user;
//                    promo.n_total_uses = $scope.promo.n_total_uses;
//                    promo.begin_at = $scope.promo.begin_at;
//                    promo.end_at = $scope.promo.end_at;

                    $modalInstance.close();
                });
            }

        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]);
