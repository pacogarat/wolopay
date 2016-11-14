smartApp.factory('APILanguages' , ['$http', function ($http) {
    return {
        getAll: function (appId){
            appId = appId || '';
            return $http.get('/admin/api/language?app_id='+appId);
        },
        updateByApp: function (appId, languages){
            return $http.put('/admin/api/language/'+appId, {languages: languages});
        }
    };
}]);
