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
        getCostOfLife: function (price, countryId, countryIdWanted, prettyPrice){
            prettyPrice = prettyPrice || 0;
            return $http.get('/admin/api/country/cost_of_life/'+price+'/'+countryId+'/'+countryIdWanted+'?pretty_price='+prettyPrice, { cache: true});
        },
        getCostOfLifeVirtual: function (price, countryId, countryIdWanted, prettyPrice){
            prettyPrice = prettyPrice || 0;
            return $http.get('/admin/api/country/cost_of_life/virtual/'+price+'/'+countryId+'/'+countryIdWanted+'?pretty_price='+prettyPrice, { cache: true});
        },
        getExchange: function (price, countryId, countryIdWanted, prettyPrice){
            prettyPrice = prettyPrice || 0;
            return $http.get('/admin/api/country/exchange/'+price+'/'+countryId+'/'+countryIdWanted+'?pretty_price='+prettyPrice, { cache: true});
        },
        getExchangeVirtual: function (price, countryId, countryIdWanted, prettyPrice){
            prettyPrice = prettyPrice || 0;
            return $http.get('/admin/api/country/exchange/virtual/'+price+'/'+countryId+'/'+countryIdWanted+'?pretty_price='+prettyPrice, { cache: true});
        },
        getAll: function (){
            return $http.get('/admin/api/country');
        },
        getAllStandard: function (){
            return $http.get('/admin/api/country/standard');
        },
        getAllByAppIdAvailable: function (appId){
            return $http.get('/admin/api/country?app_id='+appId+'&pmpc=1');
        },
        getBlackListedByAppId: function (appId){
            return $http.get('/admin/api/app/'+appId+'/country/blacklisted');
        },
        addBlackListedToApp: function(countryId, appId, state){
            return $http.post('/admin/api/app/'+appId+'/country/'+countryId+'/blacklisted', {blacklisted: state});
        }
    };
}]);