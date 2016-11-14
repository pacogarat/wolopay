angular.module('app.controllers', [])
    .factory('settings', ['$rootScope', function ($rootScope) {
        // supported languages

        var settings = {
            languages: [
                {
                    language: 'English',
                    translation: 'English',
                    langCode: 'en',
                    flagCode: 'us'
                },
                {
                    language: 'Spanish',
                    translation: 'Español',
                    langCode: 'es',
                    flagCode: 'es'
                },
                {
                    language: 'German',
                    translation: 'Deutsch',
                    langCode: 'de',
                    flagCode: 'de'
                },
                {
                    language: 'Korean',
                    translation: '한국의',
                    langCode: 'ko',
                    flagCode: 'kr'
                },
                {
                    language: 'French',
                    translation: 'Français',
                    langCode: 'fr',
                    flagCode: 'fr'
                },
                {
                    language: 'Portuguese',
                    translation: 'Português',
                    langCode: 'pt',
                    flagCode: 'br'
                },
                {
                    language: 'Russian',
                    translation: 'русский',
                    langCode: 'ru',
                    flagCode: 'ru'
                },
                {
                    language: 'Chinese',
                    translation: '中國的',
                    langCode: 'zh',
                    flagCode: 'cn'
                }
            ]

        };

        return settings;

    }])

    .controller('PageViewController', ['$scope', '$route', '$animate', function ($scope, $route, $animate) {
        // controler of the dynamically loaded views, for DEMO purposes only.
        /*$scope.$on('$viewContentLoaded', function() {

         });*/
    }])

    .controller('LangController', ['$scope', 'settings', 'localize', function ($scope, settings, localize) {
        $scope.languages = settings.languages;
        $scope.currentLang = settings.currentLang;
        $scope.setLang = function (lang) {
            settings.currentLang = lang;
            $scope.currentLang = lang;
            localize.setLang(lang);
        };

        // set the default language
        $scope.setLang($scope.currentLang);

    }])


;

angular.module('app.demoControllers', [])
    .controller('WidgetDemoCtrl', ['$scope', '$sce', function ($scope, $sce) {
        $scope.title = 'Wolopay';
        $scope.icon = 'fa fa-user';
        $scope.toolbars = [
            $sce.trustAsHtml('<div class="label label-success">\
				<i class="fa fa-arrow-up"></i> 2.35%\
			</div>'),
            $sce.trustAsHtml('<div class="btn-group" data-toggle="buttons">\
		        <label class="btn btn-default btn-xs active">\
		          <input type="radio" name="style-a1" id="style-a1"> <i class="fa fa-play"></i>\
		        </label>\
		        <label class="btn btn-default btn-xs">\
		          <input type="radio" name="style-a2" id="style-a2"> <i class="fa fa-pause"></i>\
		        </label>\
		        <label class="btn btn-default btn-xs">\
		          <input type="radio" name="style-a2" id="style-a3"> <i class="fa fa-stop"></i>\
		        </label>\
		    </div>')
        ];

        $scope.content = $sce.trustAsHtml('\
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
    }])


;
