angular.module( 'ui.bootstrap.popover' )
    .directive("popoverHtmlUnsafePopup", function () {
        return {
            restrict: "EA",
            replace: true,
            scope: { title: "@", content: "@", placement: "@", animation: "&", isOpen: "&" },
            templateUrl: "template/popover/popover-html-unsafe-popup.html"
        };
    })

    .directive("popoverHtmlUnsafe", [ "$tooltip", function ($tooltip) {
        return $tooltip("popoverHtmlUnsafe", "popover", "click");
    }]);