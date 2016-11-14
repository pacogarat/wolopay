smartApp.factory('APIPromoCode' , ['$http', function ($http) {
    return {
        create: function(appId, promoId, promoCode){
            return $http.post('/admin/api/app/'+appId+'/promo/'+promoId+'/promo_code', promoCode);
        },
        update: function(appId, promoId, promoCodeId, promoCode){
            return $http.put('/admin/api/app/'+appId+'/promo/'+promoId+'/promo_code/'+promoCodeId, promoCode);
        },
        delete: function(appId, promoId, promoCodeId){
            return $http.delete('/admin/api/app/'+appId+'/promo_code/'+promoCodeId);
        },
        copy: function(appId, promoCodeId, times){
            times = times || 1;
            return $http.post('/admin/api/app/'+appId+'/promo_code/'+promoCodeId+'/copy?times='+times);
        }

    };
}]);
