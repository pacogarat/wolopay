angular.module('shopApp').controller('ShoppingCartCtrl', ['$rootScope', '$scope',
    function ($rootScope, $scope) {

        $scope.getAppShopHasArticleFromCart = function(id){

            for (var i = 0; i < $rootScope.current.cart.length; i++) {
                if ($rootScope.current.cart[i].article.id == id)
                    return $rootScope.current.cart[i];
            }

            return null;
        };
}]);