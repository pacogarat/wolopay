smartApp.directive("currency", function () {
        return {
            restrict: "EA",
            replace: true,
            scope: { title: "@", content: "@", placement: "@", animation: "&", isOpen: "&" },
            templateUrl: "template/popover/popover-html-unsafe-popup.html"
        };
    })

    .directive("popoverHtmlUnsafe", [ "$tooltip", "$compile", function ($tooltip, $compile) {
            return $tooltip("popoverHtmlUnsafe", "popover", "click");
    }]);