angular.module('shopApp').factory('HttpInterceptor', [ '$q' , '$log', 'alerts',  function ($q, $log, alerts) {

    return {
        request: function (config) {
            console.log("REQUEST CONFIGURATION");
            // JWT come from layout
            config.headers = config.headers || {};
            config.headers.Authorization = jwt;

            $log.debug('REQUEST', config.url);
            $log.debug('HEADERS', config.headers);

            return config;
        },
        response: function(response) {

            $log.debug('RESPONSE', response.data);

            return response;
        },
        responseError: function (response) {

            $log.error('RESPONSE ERROR', response);

            if (response.status === 401 || response.status === 403) {
                alerts.addWarning("warnings.session_expired");

            } else if (response.status === 404) {
                alerts.addError("errors.404");

            } else if (response.status === 500 || response.status === 422) {

                alerts.addError("errors.500");
            }

            if (response.status < 200  || response.status >= 300 )
            {
                if (typeof ga !== 'undefined')
                {
                    ga('send', 'exception', {
                        'exDescription': '500, url: '+response.config.url,
                        'exFatal': true
                    });
                }
            }

            return $q.reject(response);
        }
    };

}]);