smartApp.directive('dialogConfirmation', [ 'dialogs', '$translate', function(dialogs, $translate) {
    return {
        restrict: 'A',
        replace: false,
        transclude: false,
        scope: {
            callback: '&callback'
        },
        link: function(scope, elem, attrs) {

            elem.bind('click', function() {

                var header = attrs.title || 'dialog.are_u_sure_title_default' ;
                var msg = attrs.msg || 'dialog.are_u_sure_desc_default';

                $translate(['yes', 'no', 'logout', 'logout_extra', header, msg]).then(function(translations){

                    $.SmartMessageBox({
                        title: "<i class='glyphicon glyphicon-remove txt-color-orangeDark' style='color: #FF1717 !important'></i> "+translations[header]+" <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
                        content: translations[msg],
                        buttons: '['+translations.no+']['+translations.yes+']'

                    }, function (ButtonPressed) {
                        if (ButtonPressed == translations.yes) {
                            scope.callback();
                        }
                    });

                });
            });
        }

//        link: function(scope, elem, attrs) {
//
//            elem.bind('click', function() {
//
//                var dlg = dialogs.confirm();
//                dlg.result.then(function(btn){
//
//                    scope.callback();
//
//                },function(btn){
//
//                });
//            });
//        }
    }
}]);