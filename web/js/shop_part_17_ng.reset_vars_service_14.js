shopApp.factory('resetVars', [ '$log', '$rootScope', 'sliders', '$timeout',  function ($log, $rootScope, sliders, $timeout) {
    return {
        shop: function () {

            $log.debug('Normal Reset');
            $rootScope.current.articlePMPCA = null;
            $rootScope.current.appShopHasArticle = null;
            $rootScope.current.articlePMPCAs = null;
            $rootScope.current.appShopHasArticles = null;
            $rootScope.current.state = null;
            $rootScope.current.operator = null;


        }
    };

}]);