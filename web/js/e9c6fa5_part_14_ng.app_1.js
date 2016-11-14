var mods = ['pascalprecht.translate', 'ngAnimate', 'timer'];

// chosen not available from mobile devices
if (window.innerWidth >= 700 && screen.width >= 700)
    mods.push('localytics.directives');

var shopApp = angular.module('shopApp', mods);

shopApp.config(['$logProvider', '$httpProvider', '$interpolateProvider', '$translateProvider', function($logProvider, $httpProvider, $interpolateProvider, $translateProvider){

        $logProvider.debugEnabled(propertiesDefault.d);

        $httpProvider.interceptors.push('HttpInterceptor');
        // to solve twig problem
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');

        $translateProvider.useStaticFilesLoader({
            prefix: propertiesDefault.domainMain + Routing['translations_shop_common'].replace('{domainName}', propertiesDefault.appId).replace("{language}.json", ''),
            suffix: '.json'
        });

        $translateProvider
            .preferredLanguage(propertiesDefault.language.id)
            .fallbackLanguage('en')
        ;

    }])
    .factory('socketFactory', function () {

        var singleton;

        function waitForElement(callback){
            if(typeof io !== "undefined"){
                //variable exists, do what you want
                singleton = io.connect(propertiesDefault.nodeServer);
                callback(singleton);
            }
            else{
                setTimeout(function(){
                    waitForElement(callback);
                },250);
            }
        }

        return {
            get: function(callback){
                callback = callback || function(){};
                return waitForElement(callback);
            }
        };
    })
    .run(['$rootScope', 'Device', '$log', function($rootScope, Device, $log){

        $log.debug('Angular Execution Starting');

        $rootScope.current = {
            country: propertiesDefault.country, // propertiesDefault comes from layout
            articleTab: propertiesDefault.articleTab,
            appId: propertiesDefault.appId,
            gamerId: propertiesDefault.gamerId,
            gamerExternalId: propertiesDefault.gamerExternalId,
            levelCategoryId: propertiesDefault.levelCategoryId,
            transactionId: propertiesDefault.transactionId,
            appShopHasArticle: null,
            articlePMPCA: null,
            language: propertiesDefault.language,
            languages: propertiesDefault.languages,
            state: null,
            tutorialEnabled: propertiesDefault.tutorialEnabled,
            tutorialPromoCode: propertiesDefault.tutorialPromoCode,
            fixedCountry: propertiesDefault.fixedCountry,
            cart: [],
            cartOpen: false,
            itemTabSelected: []
        };

        $rootScope.articleSelected = propertiesDefault.articleSelected;
        $rootScope.returnUrl = propertiesDefault.returnUrl;
        $rootScope.feedback = false;
        $rootScope.v = propertiesDefault.v;
        $rootScope.isModule = propertiesDefault.isModule;
        $rootScope.productsRows = propertiesDefault.productsRows;
        $rootScope.payMethodsRows = propertiesDefault.payMethodsRows;
        $rootScope.firstPayMethods = propertiesDefault.firstPayMethods;
        $rootScope.options = propertiesDefault;
        $rootScope.domain = propertiesDefault.domainMain;
        $rootScope.hasCart = propertiesDefault.hasCart;
        $rootScope.hasCategories = propertiesDefault.hasCategories;

        $rootScope.device = {
            hasMouse: (Device.hasMouse() && Device.isBigScreen())
        };

        $log.debug("Device "+($rootScope.device.hasMouse ? 'Desktop' : 'Mobile') + " - " + Device.isBigScreen()+Device.hasMouse());

}]);

