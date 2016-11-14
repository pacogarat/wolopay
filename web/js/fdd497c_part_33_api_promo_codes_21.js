smartApp.factory('APIPromoCodes' , ['$http', function ($http) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/app/'+appId+'/promo-codes');
        },

    };
}]);
