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

    .directive('breadcrumb', ['ribbon', '$translate', '$compile', function (ribbon, $translate, $compile) {
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
                });
                scope.updateDOM = function () {
                    element.empty();
                    angular.forEach(scope.breadcrumbs, function (crumb) {
                        var li = angular.element('<li data-translate="' + crumb + '">' + crumb + '</li>');
                        $translate(crumb).then(function (crumbTranslated) {
                            li.text(crumbTranslated);

                            $compile(li)(scope);
                            element.append(li);
                        });
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
					<a href="" title="{{title | translate}}">\
						<i data-ng-if="hasIcon" class="{{ icon }}"><em data-ng-if="hasIconCaption"> {{ iconCaption }} </em></i>\
						<span class="menu-item-parent" data-translate="{{ title }}">{{ title }}</span>\
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
    .directive('navItem', ['ribbon', '$window', '$translate', function (ribbon, $window, $translate) {
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
                        $window.document.title = $translate(scope.title);
                        $('title').attr('data-translate',scope.title)
                        scope.setBreadcrumb();
                    } else {
                        if (angular.isDefined(navgroupCtrl) && navgroupCtrl) navgroupCtrl.setActive(false);
                    }

                });

                scope.openParents = scope.isActive(scope.view);
                scope.isChild = navgroupCtrl && angular.isDefined(navgroupCtrl);

                scope.setBreadcrumb = function () {
                    var crumbs = [];
                    $translate(scope.title).then(function(titleTranslated){
                        crumbs.push(titleTranslated);
                        // get parent menus
                        var test = element.parents('nav li').each(function () {
                            var el = angular.element(this);
                            var parent = el.find('.menu-item-parent:eq(0)');
                            crumbs.push(parent.data('translate').trim());
                            if (scope.openParents) {
                                // open menu on first load
                                parent.trigger('click');
                            }
                        });
                        // this should be only fired upon first load so let's set this to false now
                        scope.openParents = false;
                        ribbon.updateBreadcrumb(crumbs);
                    });
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
					<a href="{{ getItemUrl(view) }}" target="{{ getItemTarget() }}" title="{{ title | translate }}">\
						<i data-ng-if="hasIcon" class="{{ icon }}"><em data-ng-if="hasIconCaption"> {{ iconCaption }} </em></i>\
						<span ng-class="{\'menu-item-parent\': !isChild}" data-translate="{{ title }}"> {{ title }} </span>\
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
					<h2 data-translate="{{ title }}"></h2>\
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