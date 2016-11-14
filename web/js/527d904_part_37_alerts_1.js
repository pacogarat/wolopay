smartApp.factory('alerts', ['$rootScope', '$timeout', '$translate', function ($rootScope, $timeout, $translate) {

    return {
        addError: function (msg, title) {
            title = title || 'alerts.error';
            $.smallBox({
                title : $translate(title),
                content : $translate(msg),
                color : "#A65858",
                iconSmall : "fa fa-times bounce animated",
                timeout : 10000
            });
        },
        addWarning: function (msg, title) {
            title = title || 'alerts.warning';
            $.smallBox({
                title : $translate(title),
                content : $translate(msg),
                color : "#C79121",
                iconSmall : "fa fa-cloud bounce animated",
                timeout : 10000
            });
        },
        addInfo: function (msg, title) {
            title = title || 'alerts.info';
            $.smallBox({
                title : $translate(title),
                content : $translate(msg),
                color : "#739E73",
                iconSmall : "fa fa-thumbs-up bounce animated",
                timeout : 10000
            });
        }

    };
}]);