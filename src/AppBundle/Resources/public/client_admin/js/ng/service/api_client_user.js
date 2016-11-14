smartApp.factory('APIClientUser' , ['$http', function ($http) {
    return {
        setLanguage: function (lang){
            return $http.get('/admin/api/client_user/language/set/'+lang);
        }
    };
}]);
