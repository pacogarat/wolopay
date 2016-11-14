smartApp.factory('APIPayMethodProviderHasCountry' , ['$http', function ($http) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/pay_methods_provider_has_country_special/app/app/'+appId);
        }
    };
}]);
