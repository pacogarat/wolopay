smartApp.factory('APIOffers' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function(appId){
            return $http.get('/admin/api/offer/'+appId);
        },
        getByAppIdAndId: function(appId, id){
            return $http.get('/admin/api/offer/'+appId+'/'+id);
        },
        insert: function (appId, name, appShopsIds, countriesIds, articles_ids, date_from, date_to, local_time, price, quantity_extra, limit_purchases, limit_per_user, pretty_price){

            return $http.post('/admin/api/offer/'+appId, {name: name, shops_ids: appShopsIds, countries: countriesIds,
                articles_ids: articles_ids, date_from: date_from, date_to: date_to, local_time: local_time, price:price,
                quantity_extra: quantity_extra, limit_purchases: limit_purchases, limit_per_user: limit_per_user,
                pretty_price: pretty_price
            });
        },
        update: function (appId, id, name, appShopsIds, countriesIds, articles_ids, date_from, date_to, local_time, price, quantity_extra, limit_purchases, limit_per_user, pretty_price){

            return $http.put('/admin/api/offer/'+appId+'/'+id, {name: name, shops_ids: appShopsIds, countries: countriesIds,
                articles_ids: articles_ids, date_from: date_from, date_to: date_to, local_time: local_time, price:price,
                quantity_extra: quantity_extra, limit_purchases: limit_purchases, limit_per_user: limit_per_user,
                pretty_price: pretty_price
            });
        },
        deleteById: function (id){
            return $http.delete('/admin/api/offer/'+id);
        }
    };
}]);
