shopApp.controller('ArticlesPMPCAListCtrl', function ($scope, $rootScope, $translate) {

    $scope.activate = function (articlePMPCA)
    {
        if ($rootScope.current.appShopHasArticle == null)
            return;

        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'paymethod '+articlePMPCA.name+' selected', 'clicked');
        }

        var providerName = articlePMPCA.name;

        $rootScope.current.articlePMPCA = articlePMPCA;

        if (articlePMPCA.pay_category.id == 'mobile' && articlePMPCA.is_our_implementation)
            $rootScope.current.state = 'select_sms_operator';
        else if (articlePMPCA.pay_category.id == 'promo_code' && articlePMPCA.is_our_implementation)
            $rootScope.current.state = 'write_a_valid_code';
        else
            $rootScope.current.state = 'ready_to_buy';

    }

});