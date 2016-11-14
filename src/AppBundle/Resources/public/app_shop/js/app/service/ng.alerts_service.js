// Routing is external provided by FosJsBundle

angular.module('shopApp').factory('alerts', ['$rootScope', '$timeout', function ($rootScope, $timeout) {

    $rootScope.infos = [];
    $rootScope.errors = [];
    $rootScope.warnings = [];
    var miliSecondsDelay = 100000, maxAlerts = 2;

    function addMsg(arr, msgTxt)
    {
        var msg = {msg: msgTxt};
        arr.push(msg);

        if (arr.length > maxAlerts)
            remove(arr, arr[arr.length -1]);
        else
            $timeout(function(){ remove(arr, msg); }, miliSecondsDelay);
    }

    function remove(arr, msg)
    {
        arr.splice( arr.indexOf(msg), 1 );
    }

    return {
        addError: function (msg) {
            addMsg($rootScope.errors, msg);
        },
        addWarning: function (msg) {
            addMsg($rootScope.warnings, msg);
        },
        addInfo: function (msg) {
            addMsg($rootScope.infos, msg);
        },
        removeError: function (msg) {
            remove($rootScope.errors, msg);
        },
        removeWarning: function (msg) {
            remove($rootScope.warnings, msg);
        },
        removeInfo: function (msg) {
            remove($rootScope.infos, msg);
        }

    };
}]);