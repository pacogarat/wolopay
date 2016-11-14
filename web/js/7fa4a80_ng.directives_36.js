// APP DIRECTIVES
// main directives
angular.module('app.main', [])
    // initiate body
    .directive('body', function () {
        return {
            restrict: 'E',
            link: function (scope, element, attrs) {
                element.on('click', 'a[href="#"], [data-toggle]', function (e) {
                    e.preventDefault();
                })
            }
        }
    })

    .factory('ribbon', ['$rootScope', function ($rootScope) {
        var ribbon = {
            currentBreadcrumb: [],
            updateBreadcrumb: function (crumbs) {
                crumbs.push('Home');
                var breadCrumb = crumbs.reverse();
                ribbon.currentBreadcrumb = breadCrumb;
                $rootScope.$broadcast('navItemSelected', breadCrumb);
            }
        };

        return ribbon;
    }])

    .directive('action', function (localize) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                /*
                 * SMART ACTIONS
                 */
                var smartActions = {

                    // LOGOUT MSG
                    userLogout: function ($this) {
                        var no = localize.localizeText("no"),
                            yes = localize.localizeText("yes");
                        // ask verification
                        $.SmartMessageBox({
                            title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> "+localize.localizeText("logout")+" <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
                            content: localize.localizeText("logout_extra"),
                            buttons: '['+no+']['+yes+']'

                        }, function (ButtonPressed) {
                            if (ButtonPressed == yes) {
                                $.root_.addClass('animated fadeOutUp');
                                setTimeout(logout, 1000);
                            }
                        });
                        function logout() {
                            window.location = $this.attr('href');
                        }

                    },

                    // RESET WIDGETS
                    resetWidgets: function ($this) {
                        $.widresetMSG = $this.data('reset-msg');
                        var no = localize.localizeText("no"),
                            yes = localize.localizeText("yes");
                        $.SmartMessageBox({
                            title: "<i class='fa fa-refresh' style='color:green'></i> "+localize.localizeText("clear_storage"),
                            content: $.widresetMSG || localize.localizeText("clear_storage_extra"),
                            buttons: '['+no+']['+yes+']'
                        }, function (ButtonPressed) {
                            if (ButtonPressed == yes && localStorage) {
                                localStorage.clear();
                                location.reload();
                            }

                        });
                    },

                    // LAUNCH FULLSCREEN
                    launchFullscreen: function (element) {

                        if (!$.root_.hasClass("full-screen")) {

                            $.root_.addClass("full-screen");

                            if (element.requestFullscreen) {
                                element.requestFullscreen();
                            } else if (element.mozRequestFullScreen) {
                                element.mozRequestFullScreen();
                            } else if (element.webkitRequestFullscreen) {
                                element.webkitRequestFullscreen();
                            } else if (element.msRequestFullscreen) {
                                element.msRequestFullscreen();
                            }

                        } else {

                            $.root_.removeClass("full-screen");

                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            } else if (document.mozCancelFullScreen) {
                                document.mozCancelFullScreen();
                            } else if (document.webkitExitFullscreen) {
                                document.webkitExitFullscreen();
                            }

                        }

                    },

                    // MINIFY MENU
                    minifyMenu: function ($this) {
                        if (!$.root_.hasClass("menu-on-top")) {
                            $.root_.toggleClass("minified");
                            $.root_.removeClass("hidden-menu");
                            $('html').removeClass("hidden-menu-mobile-lock");
                            $this.effect("highlight", {}, 500);
                        }
                    },

                    // TOGGLE MENU
                    toggleMenu: function () {
                        if (!$.root_.hasClass("menu-on-top")) {
                            $('html').toggleClass("hidden-menu-mobile-lock");
                            $.root_.toggleClass("hidden-menu");
                            $.root_.removeClass("minified");
                        } else if ($.root_.hasClass("menu-on-top") && $.root_.hasClass("mobile-view-activated")) {
                            $('html').toggleClass("hidden-menu-mobile-lock");
                            $.root_.toggleClass("hidden-menu");
                            $.root_.removeClass("minified");
                        }
                    },

                    // TOGGLE SHORTCUT
                    toggleShortcut: function () {

                        if (shortcut_dropdown.is(":visible")) {
                            shortcut_buttons_hide();
                        } else {
                            shortcut_buttons_show();
                        }

                        // SHORT CUT (buttons that appear when clicked on user name)
                        shortcut_dropdown.find('a').click(function (e) {
                            e.preventDefault();
                            window.location = $(this).attr('href');
                            setTimeout(shortcut_buttons_hide, 300);

                        });

                        // SHORTCUT buttons goes away if mouse is clicked outside of the area
                        $(document).mouseup(function (e) {
                            if (!shortcut_dropdown.is(e.target) && shortcut_dropdown.has(e.target).length === 0) {
                                shortcut_buttons_hide();
                            }
                        });

                        // SHORTCUT ANIMATE HIDE
                        function shortcut_buttons_hide() {
                            shortcut_dropdown.animate({
                                height: "hide"
                            }, 300, "easeOutCirc");
                            $.root_.removeClass('shortcut-on');

                        }

                        // SHORTCUT ANIMATE SHOW
                        function shortcut_buttons_show() {
                            shortcut_dropdown.animate({
                                height: "show"
                            }, 200, "easeOutCirc");
                            $.root_.addClass('shortcut-on');
                        }

                    }

                };

                var actionEvents = {
                    userLogout: function (e) {
                        smartActions.userLogout(element);
                    },
                    resetWidgets: function (e) {
                        smartActions.resetWidgets(element);
                    },
                    launchFullscreen: function (e) {
                        smartActions.launchFullscreen(document.documentElement);
                    },
                    minifyMenu: function (e) {
                        smartActions.minifyMenu(element);
                    },
                    toggleMenu: function (e) {
                        smartActions.toggleMenu();
                    },
                    toggleShortcut: function (e) {
                        smartActions.toggleShortcut();
                    }
                };

                if (angular.isDefined(attrs.action) && attrs.action != '') {
                    var actionEvent = actionEvents[attrs.action];
                    if (typeof actionEvent === 'function') {
                        element.on('click', function (e) {
                            actionEvent(e);
                            e.preventDefault();
                        });
                    }
                }

            }
        };
    })

    .directive('header', function () {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {
                // SHOW & HIDE MOBILE SEARCH FIELD
                angular.element('#search-mobile').click(function () {
                    $.root_.addClass('search-mobile');
                });

                angular.element('#cancel-search-js').click(function () {
                    $.root_.removeClass('search-mobile');
                });
            }
        };
    })

    .controller('breadcrumbController', ['$scope', function ($scope) {
        $scope.breadcrumbs = [];
        $scope.$on('navItemSelected', function (name, crumbs) {
            $scope.setBreadcrumb(crumbs);
        });

        $scope.setBreadcrumb = function (crumbs) {
            $scope.breadcrumbs = crumbs;
        }
    }])

    .directive('breadcrumb', ['ribbon', 'localize', '$compile', function (ribbon, localize, $compile) {
        return {
            restrict: 'AE',
            controller: 'breadcrumbController',
            replace: true,
            link: function (scope, element, attrs) {
                scope.$watch('breadcrumbs', function (newVal, oldVal) {
                    if (newVal !== oldVal) {
                        // update DOM
                        scope.updateDOM();
                    }
                })
                scope.updateDOM = function () {
                    element.empty();
                    angular.forEach(scope.breadcrumbs, function (crumb) {
                        var li = angular.element('<li data-localize="' + crumb + '">' + crumb + '</li>');
                        li.text(localize.localizeText(crumb));

                        $compile(li)(scope);
                        element.append(li);
                    });
                };

                // set the current breadcrumb on load
                scope.setBreadcrumb(ribbon.currentBreadcrumb);
                scope.updateDOM();
            },
            template: '<ol class="breadcrumb"></ol>'
        }
    }])
;

// directives for localization
angular.module('app.localize', [])

    .factory('localize', ['$http', '$rootScope', '$window', '$sce', function ($http, $rootScope, $window, $sce) {
        var localize = {
            defaultCallBack: {},
            currentLocaleData: {},
            currentLang: {},
            setLang: function (lang) {
                $http({method: 'GET', url: localize.getLangUrl(lang), cache: false})
                    .success(function (data) {
                        localStorage.setItem('language-'+$rootScope.usernameId, JSON.stringify(lang));
                        localize.currentLocaleData = data;
                        localize.currentLang = lang;
                        $rootScope.$broadcast('localizeLanguageChanged');
                    }).error(function (data) {
                        console.log('Error updating language!');
                    })
            },
            getLangUrl: function (lang) {

                return '/translations/g/admin/' + lang.langCode + '.js';
            },

            localizeText: function (sourceText, replaceText) {
                var result;
                replaceText = replaceText || {};

                if (localize.currentLocaleData[sourceText])
                    result = localize.currentLocaleData[sourceText];
                else if (localize.defaultCallBack[sourceText]) // callback
                    result =  localize.defaultCallBack[sourceText];
                else
                    result = sourceText;

                angular.forEach(replaceText, function(value, key) {
                    result = result.replace(key, value);
                });

                return result;
            }
        };

        $http({method: 'GET', url: localize.getLangUrl({langCode: 'en'}), cache: false})
            .success(function (data) {
                localize.defaultCallBack = data;
            }).error(function (data) {
                console.log('Error updating language!');
            });

        return localize;
    }])

    .directive('localize', ['localize', function (localize) {
        return {
            restrict: 'A',
            scope: {
                sourceText: '@localize'
            },
            link: function (scope, element, attrs) {

                function execute(scope){
                    var localizedText = localize.localizeText(scope.sourceText);
                    if (element.is('input, textarea')) element.attr('placeholder', localizedText)
                    else element.text(localizedText);
                }

                scope.$on('localizeLanguageChanged', function () {
                    execute(scope);
                });

                execute(scope);
            }
        }
    }])
;

// directives for navigation
angular.module('app.navigation', [])
    .directive('navigation', function () {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {

            }],
            transclude: true,
            replace: true,
            link: function (scope, element, attrs) {

                element.first().jarvismenu({
                    accordion: true,
                    speed: $.menu_speed,
                    closedSign: '<em class="fa fa-plus-square-o"></em>',
                    openedSign: '<em class="fa fa-minus-square-o"></em>'
                });

                // SLIMSCROLL FOR NAV
                if ($.fn.slimScroll) {
                    element.slimScroll({
                        height: '100%'
                    });
                }

                scope.getElement = function () {
                    return element;
                }
            },
            template: '<nav><ul data-ng-transclude=""></ul></nav>'
        };
    })

    .controller('NavGroupController', ['$scope', function ($scope) {
        $scope.active = false;
        $scope.hasIcon = angular.isDefined($scope.icon);
        $scope.hasIconCaption = angular.isDefined($scope.iconCaption);

        this.setActive = function (active) {
            $scope.active = active;
        }

    }])
    .directive('navGroup', function () {
        return {
            restrict: 'AE',
            controller: 'NavGroupController',
            transclude: true,
            replace: true,
            scope: {
                icon: '@',
                title: '@',
                iconCaption: '@',
                active: '=?'
            },
            template: '\
				<li data-ng-class="{active: active}">\
					<a href="" title="{{title | localize}}">\
						<i data-ng-if="hasIcon" class="{{ icon }}"><em data-ng-if="hasIconCaption"> {{ iconCaption }} </em></i>\
						<span class="menu-item-parent" data-localize="{{ title }}">{{ title }}</span>\
					</a>\
					<ul data-ng-transclude=""></ul>\
				</li>'

        };
    })

    .controller('NavItemController', ['$rootScope', '$scope', '$location', function ($rootScope, $scope, $location) {
        $scope.isChild = false;
        $scope.active = false;
        $scope.isActive = function (viewLocation) {
            $scope.active = viewLocation === $location.path();
            return $scope.active;
        };

        $scope.hasIcon = angular.isDefined($scope.icon);
        $scope.hasIconCaption = angular.isDefined($scope.iconCaption);

        $scope.getItemUrl = function (view) {
            if (angular.isDefined($scope.href)) return $scope.href;
            if (!angular.isDefined(view)) return '';
            return '#' + view;
        };

        $scope.getItemTarget = function () {
            return angular.isDefined($scope.target) ? $scope.target : '_self';
        };

    }])
    .directive('navItem', ['ribbon', '$window', 'localize', function (ribbon, $window, localize) {
        return {
            require: ['^navigation', '^?navGroup'],
            restrict: 'AE',
            controller: 'NavItemController',
            scope: {
                title: '@',
                view: '@',
                icon: '@',
                iconCaption: '@',
                href: '@',
                target: '@'
            },
            link: function (scope, element, attrs, parentCtrls) {

                var navCtrl = parentCtrls[0],
                    navgroupCtrl = parentCtrls[1]
                ;

                scope.$watch('active', function (newVal, oldVal) {

                    if (newVal) {
                        if (angular.isDefined(navgroupCtrl) && navgroupCtrl) navgroupCtrl.setActive(true);
                        $window.document.title = localize.localizeText(scope.title);
                        $('title').attr('data-localize',scope.title)
                        scope.setBreadcrumb();
                    } else {
                        if (angular.isDefined(navgroupCtrl) && navgroupCtrl) navgroupCtrl.setActive(false);
                    }

                });

                scope.openParents = scope.isActive(scope.view);
                scope.isChild = navgroupCtrl && angular.isDefined(navgroupCtrl);

                scope.setBreadcrumb = function () {
                    var crumbs = [];
                    crumbs.push(localize.localizeText(scope.title));
                    // get parent menus
                    var test = element.parents('nav li').each(function () {
                        var el = angular.element(this);
                        var parent = el.find('.menu-item-parent:eq(0)');
                        crumbs.push(parent.data('localize').trim());
                        if (scope.openParents) {
                            // open menu on first load
                            parent.trigger('click');
                        }
                    });
                    // this should be only fired upon first load so let's set this to false now
                    scope.openParents = false;
                    ribbon.updateBreadcrumb(crumbs);
                };

                element.on('click', 'a[href!="#"]', function () {
                    if ($.root_.hasClass('mobile-view-activated')) {
                        $.root_.removeClass('hidden-menu');
                        $('html').removeClass("hidden-menu-mobile-lock");
                    }
                });

            },
            transclude: true,
            replace: true,
            template: '\
				<li data-ng-class="{active: isActive(view)}">\
					<a href="{{ getItemUrl(view) }}" target="{{ getItemTarget() }}" title="{{ title | localize }}">\
						<i data-ng-if="hasIcon" class="{{ icon }}"><em data-ng-if="hasIconCaption"> {{ iconCaption }} </em></i>\
						<span ng-class="{\'menu-item-parent\': !isChild}" data-localize="{{ title }}"> {{ title }} </span>\
						<span data-ng-transclude=""></span>\
					</a>\
				</li>'
        };
    }])
;

angular.module('app.smartui', [])
    .directive('widgetGrid', function () {
        return {
            restrict: 'AE',
            link: function (scope, element, attrs) {
                scope.setup_widget_desktop = function () {
                    if ($.fn.jarvisWidgets && $.enableJarvisWidgets) {
                        element.jarvisWidgets({
                            grid: 'article',
                            widgets: '.jarviswidget',
                            localStorage: true,
                            deleteSettingsKey: '#deletesettingskey-options',
                            settingsKeyLabel: 'Reset settings?',
                            deletePositionKey: '#deletepositionkey-options',
                            positionKeyLabel: 'Reset position?',
                            sortable: true,
                            buttonsHidden: false,
                            // toggle button
                            toggleButton: true,
                            toggleClass: 'fa fa-minus | fa fa-plus',
                            toggleSpeed: 200,
                            onToggle: function () {
                            },
                            // delete btn
                            deleteButton: true,
                            deleteClass: 'fa fa-times',
                            deleteSpeed: 200,
                            onDelete: function () {
                            },
                            // edit btn
                            editButton: true,
                            editPlaceholder: '.jarviswidget-editbox',
                            editClass: 'fa fa-cog | fa fa-save',
                            editSpeed: 200,
                            onEdit: function () {
                            },
                            // color button
                            colorButton: true,
                            // full screen
                            fullscreenButton: true,
                            fullscreenClass: 'fa fa-expand | fa fa-compress',
                            fullscreenDiff: 3,
                            onFullscreen: function () {
                            },
                            // custom btn
                            customButton: false,
                            customClass: 'folder-10 | next-10',
                            customStart: function () {
                                alert('Hello you, this is a custom button...');
                            },
                            customEnd: function () {
                                alert('bye, till next time...');
                            },
                            // order
                            buttonOrder: '%refresh% %custom% %edit% %toggle% %fullscreen% %delete%',
                            opacity: 1.0,
                            dragHandle: '> header',
                            placeholderClass: 'jarviswidget-placeholder',
                            indicator: true,
                            indicatorTime: 600,
                            ajax: true,
                            timestampPlaceholder: '.jarviswidget-timestamp',
                            timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
                            refreshButton: true,
                            refreshButtonClass: 'fa fa-refresh',
                            labelError: 'Sorry but there was a error:',
                            labelUpdated: 'Last Update:',
                            labelRefresh: 'Refresh',
                            labelDelete: 'Delete widget:',
                            afterLoad: function () {
                            },
                            rtl: false, // best not to toggle this!
                            onChange: function () {

                            },
                            onSave: function () {

                            },
                            ajaxnav: $.navAsAjax // declears how the localstorage should be saved (HTML or AJAX page)

                        });
                    }
                }

                scope.setup_widget_mobile = function () {
                    if ($.enableMobileWidgets && $.enableJarvisWidgets) {
                        scope.setup_widgets_desktop();
                    }
                }

                if ($.device === "desktop") {
                    scope.setup_widget_desktop();
                } else {
                    scope.setup_widget_mobile();
                }

            }
        }
    })

    .directive('widget', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="jarviswidget" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetHeader', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            scope: {
                title: '@',
                icon: '@'
            },
            template: '\
				<header>\
					<span class="widget-icon"> <i data-ng-class="icon"></i> </span>\
					<h2 data-localize="{{ title }}"></h2>\
					<span data-ng-transclude></span>\
				</header>'
        }
    })

    .directive('widgetToolbar', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="widget-toolbar" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetEditbox', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="jarviswidget-editbox" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetBody', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div data-ng-transclude=""></div>'
        }
    })

    .directive('widgetBodyToolbar', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            scope: {
                class: '@'
            },
            template: '<div class="widget-body-toolbar" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetContent', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="widget-body" data-ng-transclude=""></div>'
        }
    })