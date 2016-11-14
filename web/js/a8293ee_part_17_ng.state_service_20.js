angular.module('shopApp').factory('state', ['$rootScope', function ($rootScope) {

    return {

        refresh: function() {

            var articlePMPCA = $rootScope.current.articlePMPCA;

            if (articlePMPCA && ($rootScope.current.appShopHasArticle || $rootScope.current.cart.length > 0))
            {
                if (articlePMPCA.pay_category && (articlePMPCA.pay_category.id == 'mobile' || articlePMPCA.pay_category.id == 'voice') && articlePMPCA.is_our_implementation)
                    $rootScope.current.state = 'select_pay_method_fixed_amount';
                else if (articlePMPCA.pay_category && articlePMPCA.pay_category.id == 'promo_code' && articlePMPCA.is_our_implementation)
                    $rootScope.current.state = 'write_a_valid_code';
                else
                    $rootScope.current.state = 'ready_to_buy';

            }else{

                $rootScope.current.state = '';
            }

        }
    };

}]);