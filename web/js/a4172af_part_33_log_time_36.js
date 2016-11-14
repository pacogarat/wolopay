smartApp.factory('LogTime' , [ '$log', function ($log) {
    return {
        time: function (title){
            if ($log.debug)
                console.time(title);
        },
        timeEnd: function (title){
            if ($log.debug)
                console.timeEnd(title);
        }
    };
}]);