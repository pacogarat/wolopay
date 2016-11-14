smartApp.factory('alerts', ['$rootScope', '$timeout', '$translate', function ($rootScope, $timeout, $translate) {

    return {
        addError: function (msg, title) {
            title = title || 'alerts.error';
            $translate([title, msg]).then(function(translations){
                $.smallBox({
                    title : translations[title],
                    content : translations[msg],
                    color : "#A65858",
                    iconSmall : "fa fa-times bounce animated",
                    timeout : 10000
                });
            })
        },
        addWarning: function (msg, title) {
            title = title || 'alerts.warning';
            $translate([title, msg]).then(function(translations){
                $.smallBox({
                    title : translations[title],
                    content : translations[msg],
                    color : "#C79121",
                    iconSmall : "fa fa-cloud bounce animated",
                    timeout : 10000
                });
            });
        },
        addInfo: function (msg, title) {
            msg = msg || 'action_completed';
            title = title || 'alerts.info';
            $translate([title, msg]).then(function(translations){
                $.smallBox({
                    title : translations[title],
                    content : translations[msg],
                    color : "#739E73",
                    iconSmall : "fa fa-thumbs-up bounce animated",
                    timeout : 10000
                });
            });
        }

    };
}]);