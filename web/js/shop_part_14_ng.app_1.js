'use strict';
var shopApp = angular.module('shopApp', ['pascalprecht.translate', 'localytics.directives', 'ngAnimate', 'timer']);

shopApp.config(function($logProvider, $httpProvider, $interpolateProvider, $translateProvider){

        $logProvider.debugEnabled(propertiesDefault.d);

        $httpProvider.interceptors.push('HttpInterceptor');
        // to solve twig problem
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');

        $translateProvider.useStaticFilesLoader({
            prefix: '/translations/shop/'+propertiesDefault.appId+'/',
            suffix: '.json'
        });

        $translateProvider
            .preferredLanguage(propertiesDefault.language.id)
            .fallbackLanguage('en')
        ;

    })
    .factory('socketFactory', function () {

        var singleton;

        return {
            get: function(){

                if (!singleton)
                    singleton = io.connect(propertiesDefault.nodeServer);

                return singleton;
            }
        };
    })
    .run(function($rootScope, Device){

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
            fixedCountry: propertiesDefault.fixedCountry
        };

        $rootScope.articleSelected = propertiesDefault.articleSelected;
        $rootScope.return = propertiesDefault.return;
        $rootScope.feedback = false;
        $rootScope.v = propertiesDefault.v;
        $rootScope.isModule = propertiesDefault.isModule;
        $rootScope.productsRows = propertiesDefault.productsRows;
        $rootScope.payMethodsRows = propertiesDefault.payMethodsRows;
        $rootScope.firstPayMethods = propertiesDefault.firstPayMethods;


        $rootScope.device = {
            hasMouse: Device.hasMouse()
        };


});

