smartApp.factory('APIGamers' , [ '$http', function ($http) {
    return {
        getByAppIdForTesting: function (appId){
            return $http.get('/admin/api/app/'+appId+'/gamers/for_testing');
        },
        setGamerForTesting: function (externalGamerId, appId, state){
            return $http.post('/admin/api/app/'+appId+'/gamers/'+externalGamerId+'/for_testing', {for_testing: state});
        },
        getByAppIdAndBlacklisted: function (appId){
            return $http.get('/admin/api/app/'+appId+'/gamers/blacklisted');
        },
        setGamerToBlacklisted: function (externalGamerId, appId, state){
            return $http.post('/admin/api/app/'+appId+'/gamers/'+externalGamerId+'/blacklisted', {blacklisted: state});
        }
    };
}]);
