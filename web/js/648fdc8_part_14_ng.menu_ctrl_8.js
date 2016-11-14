shopApp.controller('MenuListCtrl', function ($log, $scope, $rootScope, $translate, APIArticleTab, APIAppShopHasArticles, resetVars) {

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

            var exist=false;
            angular.forEach(data, function(value, key) {
                if ($rootScope.current.articleTab.id == value.id)
                    exist=true;
            });

            if (exist == false)
            {
                $log.debug('Article category changed auto because ' + $rootScope.current.articleTab.id + ' doesn\'t exist')
                $rootScope.current.articleTab = data[0];
            }

            APIAppShopHasArticles.getAll();
        });

    };


});