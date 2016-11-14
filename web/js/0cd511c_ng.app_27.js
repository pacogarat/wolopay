var smartApp = angular.module('smartApp', [

    'ngGrid',
    'ngRoute',
    'ngAnimate', // this is buggy, jarviswidget will not work with ngAnimate :(
//    'plunker',
    'app.controllers',
//    'app.demoControllers',
    'app.main',
    'app.navigation',
    'app.localize',
    'app.smartui',
    'ui.select',
    'ui.utils',
    'ui.bootstrap',
    'ui.bootstrap.tpls',
    'ui.bootstrap.datetimepicker',
    'ngUpload',
    'angular-loading-bar',
    'ckeditor',
    'ui.sortable',
    'ui.select2'
]);

smartApp.config(['$routeProvider', '$provide', '$interpolateProvider', '$httpProvider', 'uiSelectConfig', '$logProvider', 'datepickerConfig', function ($routeProvider, $provide, $interpolateProvider, $httpProvider, uiSelectConfig, $logProvider, datepickerConfig) {

    datepickerConfig.startingDay = 1;

    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    $httpProvider.interceptors.push('HttpInterceptor');
    $logProvider.debugEnabled(initVars.d);

    $routeProvider
        .when('/', {
            redirectTo: 'dashboard'
        })
        .otherwise({
            redirectTo: 'dashboard'
        })
        /* We are loading our views dynamically by passing arguments to the location url */

        // A bug in smartwidget with angular (routes not reloading).
        // We need to reload these pages everytime so widget would work
        // The trick is to add "/" at the end of the view.
        // http://stackoverflow.com/a/17588833
        .when('/:page', { // we can enable ngAnimate and implement the fix here, but it's a bit laggy
            templateUrl: function ($routeParams) {
                return '/bundles/app/client_admin/views/' + $routeParams.page + '.html?'+initVars.v;
            },
            controller: 'PageViewController'
        })
        .when('/configuration/offers/wizard/:id', {
            templateUrl: '/bundles/app/client_admin/views/configuration/offers/wizard.html?'+initVars.v,
            controller: 'OfferContainerCtrl'
        })
        .when('/projects/:id/configure', {
            templateUrl: '/bundles/app/client_admin/views/projects/configure.html?'+initVars.v,
            controller: 'ProjectConfigureController'
        })
        .when('/:page/:child*', {
            templateUrl: function ($routeParams) {
                return '/bundles/app/client_admin/views/' + $routeParams.page + '/' + $routeParams.child + '.html?'+initVars.v;
            },
            controller: 'PageViewController'
        })
        ;

    // with this, you can use $log('Message') same as $log.info('Message');
    $provide.decorator('$log', ['$delegate',
        function ($delegate) {
            // create a new function to be returned below as the $log service (instead of the $delegate)
            function logger() {
                // if $log fn is called directly, default to "info" message
                logger.info.apply(logger, arguments);
            }

            // add all the $log props into our new logger fn
            angular.extend(logger, $delegate);
            return logger;
        }]);

    uiSelectConfig.theme = 'select2';
}]);


smartApp.run(['$rootScope', 'settings', 'Permissions', 'APIRoles', '$templateCache', function ($rootScope, settings, Permissions, APIRoles, $templateCache) {

//    $rootScope.$on('$viewContentLoaded', function() {
//        $templateCache.removeAll();
//    });

    $rootScope.apps=initVars.apps;

    $rootScope.usernameId=initVars.usernameId;
    $rootScope.currencies=initVars.currencies;
    $rootScope.dateFrom=initVars.dateFrom;
    $rootScope.dateTo=initVars.dateTo;
    $rootScope.v=initVars.v;
    $rootScope.dateSelector = true;
    $rootScope.topBoxSelectors = true;

    if (localStorage.getItem('language-'+$rootScope.usernameId))
        settings.currentLang = JSON.parse(localStorage.getItem('language-'+$rootScope.usernameId));
    else
        settings.currentLang = settings.languages[0]; // en

    if (localStorage.getItem('currency-'+$rootScope.usernameId))
        $rootScope.currency=JSON.parse(localStorage.getItem('currency-'+$rootScope.usernameId));
    else
        $rootScope.currency=initVars.currency;


    if (localStorage.getItem('app-'+$rootScope.usernameId))
    {
        oldAppSeleceted = JSON.parse(localStorage.getItem('app-'+$rootScope.usernameId));
        angular.forEach(initVars.apps, function(app){
            if (app.id == oldAppSeleceted.id)
                $rootScope.app = app;
        });

    }

    if (!$rootScope.app)
        $rootScope.app=initVars.apps[0];

    APIRoles.getAll().success(function(data){
        Permissions.setPermissions(data)
    });

}]);