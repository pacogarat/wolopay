smartApp.factory('alerts', ['$rootScope', '$timeout', 'localize', function ($rootScope, $timeout, localize) {

    return {
        addError: function (msg, title) {
            title = title || 'alerts.error';
            $.smallBox({
                title : localize.localizeText(title),
                content : localize.localizeText(msg),
                color : "#A65858",
                iconSmall : "fa fa-times bounce animated",
                timeout : 10000
            });
        },
        addWarning: function (msg, title) {
            title = title || 'alerts.warning';
            $.smallBox({
                title : localize.localizeText(title),
                content : localize.localizeText(msg),
                color : "#C79121",
                iconSmall : "fa fa-cloud bounce animated",
                timeout : 10000
            });
        },
        addInfo: function (msg, title) {
            title = title || 'alerts.info';
            $.smallBox({
                title : localize.localizeText(title),
                content : localize.localizeText(msg),
                color : "#739E73",
                iconSmall : "fa fa-thumbs-up bounce animated",
                timeout : 10000
            });
        }

    };
}]);