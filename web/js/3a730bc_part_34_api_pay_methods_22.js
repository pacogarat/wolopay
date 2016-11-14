smartApp.factory('APIPayMethods' , ['$http', function ($http) {
    return {
        getAll: function (app){
            return $http.get('/admin/api/pay_methods/', { cache: true});
        },
        payMethodsWithFiltersCount: function (appId, obj){

            var serialize = function(obj) {
                var str = [];
                for(var p in obj)
                    if (obj.hasOwnProperty(p)) {
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    }
                return str.join("&");
            };

            return $http.get('/admin/api/pay_methods/count/app/'+appId+'?'+serialize(obj));
        },
        getByAppId: function (appId, active){
            active = active ? 'active=1' : '';
            return $http.get('/admin/api/pay_methods/app/'+appId+'?'+active );
        },
        getSpecialsByAppId: function (appId){
            return $http.get('/admin/api/pay_methods/specials/app/'+appId);
        }
    };
}]);
