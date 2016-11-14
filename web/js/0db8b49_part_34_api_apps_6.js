smartApp.factory('APIApps' , [ '$http', function ($http) {
    return {
        getAll: function (){
            return $http.get('/admin/api/apps');
        },
        getIsConfigured: function (appId){
            return $http.get('/admin/api/app/'+appId+'/is_configured');
        },
        getAutoConfigurationAction: function (appId){
            return $http.get('/admin/api/auto_configuration/app/'+appId);
        },
        postAutoConfigurationAction: function (appId, obj){
            return $http.post('/admin/api/auto_configuration/app/'+appId, obj);
        },
        getOneById: function (appId){
            return $http.get('/admin/api/app/'+appId);
        },
        getIpsBlackListedByAppId: function(appId){
            return $http.get('/admin/api/app/'+appId+'/ips/blacklisted');
        },
        setIpsBlackListedByAppId: function(appId, ip, state){
            return $http.post('/admin/api/app/'+appId+'/ips/blacklisted', {ip: ip, state: state});
        }
    };
}]);
