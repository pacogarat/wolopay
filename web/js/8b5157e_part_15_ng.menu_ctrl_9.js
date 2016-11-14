angular.module('shopApp').controller('MenuListCtrl', [ '$log', '$scope', '$rootScope', '$translate', 'APIArticleTab', 'APIAppShopHasArticles', 'resetVars', 'APIArticlePMPCA', 'APIWallet',
    function ($log, $scope, $rootScope, $translate, APIArticleTab, APIAppShopHasArticles, resetVars, APIArticlePMPCA, APIWallet) {

        $translate('feedback.before_u_go').then(function(translation){
            $rootScope.beforeExit = translation;
        });

        $scope.switchLanguage=function ()
        {
            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'language '+$rootScope.current.language.id+' changed', 'changed');
            }
            $translate.use($rootScope.current.language.id);
            $translate('feedback.before_u_go').then(function(translation){
                $rootScope.beforeExit = translation;
            });
        };

        $scope.changeCountry=function (){

            if (typeof ga !== 'undefined')
            {
                ga('send', 'event', 'country '+$rootScope.current.country.id+' changed', 'changed');
            }

            resetVars.shop();
            APIArticleTab.getAll(null, function(data){

                if (data.length == 0)
                    return;

                var exist=false;
                angular.forEach(data, function(value, key) {
                    if ($rootScope.current.articleTab && $rootScope.current.articleTab.id == value.id)
                    {
                        exist=true;
                        $rootScope.current.articleTab = value;
                    }
                });

                if (exist == false)
                {
                    $log.debug('Article category changed auto because ' + $rootScope.current.articleTab.id + ' doesn\'t exist')
                    $rootScope.current.articleTab = data[0];
                }

                resetVars.cart();

                if ($rootScope.firstPayMethods)
                    APIArticlePMPCA.getAll();
                else
                    APIAppShopHasArticles.getAll();

                if ($rootScope.options.walletConf.wallet_is_enabled && !$rootScope.options.walletConf.wallet_in_real_money)
                    APIWallet.getConfByCountry();
            });

        };

    }
]);