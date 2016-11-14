smartApp.factory('APIPayMethods' , ['$http', function ($http) {
    return {
        getAll: function (app){
            return $http.get('/admin/api/pay_methods/', { cache: true});
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
