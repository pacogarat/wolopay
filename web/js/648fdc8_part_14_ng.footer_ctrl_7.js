shopApp.controller('FooterCtrl', function ($rootScope, $scope, routing, pageTransition) {

    function getValidLocale(locale)
    {
        if (locale == 'es' || locale == 'en')
            return locale;

        return 'en';
    }

    $scope.askCenter = function ()
    {
        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'Ask center', 'clicked');
        }

        var url=routing.generate('support_gamer', {'transaction_id': $rootScope.current.transactionId, '_locale': $rootScope.current.language.id});
        pageTransition.iframeOpen(url);
    };

    $scope.faq = function ()
    {
        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'Faq', 'clicked');
        }

        var url=routing.generate('faq', {'_locale': getValidLocale($rootScope.current.language.id)});
        pageTransition.iframeOpen(url);
    };

    $scope.legalTerms = function ()
    {
        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'Legal', 'clicked');
        }

        var url=routing.generate('legal', {'_locale': getValidLocale($rootScope.current.language.id)});
        pageTransition.iframeOpen(url);
    };

});