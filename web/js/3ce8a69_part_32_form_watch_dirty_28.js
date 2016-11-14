smartApp.factory('FormWatchDirty', [ '$q' , '$log', '$location',  function ($q, $log, $location) {

    return {
        request: function (config) {

            $log.debug('REQUEST', config.url);

            return config;
        },
        response: function(response) {

            $log.debug('RESPONSE', response);
            // Session expired
            if (typeof response.data === "string" && response.data.indexOf("login_check") !== -1) {
                $.root_.addClass('animated fadeOutUp');
                setTimeout(function(){window.location.replace("/admin/");}, 1000);
            }

            return response;
        },
        responseError: function (response) {

//            if (response.status===403)
//                $location.path('/');

            $log.error('RESPONSE ERROR', response);

            return $q.reject(response);
        }
    };

}]);