smartApp.factory('APIPromo' , ['$http', function ($http) {
    return {
        getByAppId: function (appId, page){
            page = page || 0;
            return $http.get('/admin/api/app/'+appId+'/promos?page='+page);
        },
        create: function(appId, promo){
            return $http.post('/admin/api/app/'+appId+'/promo', promo);
        },
        update: function(appId, promoId, promo){
            return $http.put('/admin/api/app/'+appId+'/promo/'+promoId, promo);
        },
        delete: function(appId, promoId, promo){
            return $http.delete('/admin/api/app/'+appId+'/promo/'+promoId);
        }
    };
}]);
