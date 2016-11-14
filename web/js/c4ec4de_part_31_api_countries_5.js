smartApp.factory('APICountries' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppIdAndShops: function (appId,shops){
            return $http.get('/admin/api/country/'+appId+'/'+shops);
        },
        updateByApp: function (appId, countries){
            return $http.put('/admin/api/country/'+appId, {countries: countries});
        },
        getByAppId: function (appId){
            return $http.get('/admin/api/country?app_id='+appId);
        },
        getCostOfLife: function (price, countryId, countryIdWanted){
            return $http.get('/admin/api/country/cost_of_life/'+price+'/'+countryId+'/'+countryIdWanted, { cache: true});
        },
        getExchange: function (price, countryId, countryIdWanted){
            return $http.get('/admin/api/country/exchange/'+price+'/'+countryId+'/'+countryIdWanted, { cache: true});
        },
        getAll: function (){
            return $http.get('/admin/api/country');
        },
        getAllByAppIdAvailable: function (appId){
            return $http.get('/admin/api/country?app_id='+appId+'&pmpc=1');
        }
    };
}]);
