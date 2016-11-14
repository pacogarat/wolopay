// Routing is external provided by FosJsBundle

angular.module('shopApp').factory('routing', ['$rootScope', function ($rootScope) {

    return {
        generate: function (id, params) {

            if (!Routing[id])
            {
                throw 'Routing '+id+' doesnt exist';
            }

            var url=Routing[id];

            angular.forEach(params, function(value, key) {
                if (url.indexOf("{"+key+"}") != -1)
                {
                    url=url.replace("\{"+key+"\}", value);
                    delete params[key];
                }
            });

            if (Object.keys(params).length > 0)
                url+='?';

            angular.forEach(params, function(value, key) {
                url += '&'+key+'='+value;
            });

            return url;

        }
    };
}]);