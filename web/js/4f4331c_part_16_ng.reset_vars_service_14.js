angular.module('shopApp').factory('resetVars', [ '$log', '$rootScope', function ($log, $rootScope) {
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