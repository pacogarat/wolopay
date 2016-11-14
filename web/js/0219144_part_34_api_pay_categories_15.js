smartApp.factory('APIPayCategories' , [ '$http', function ($http) {
    return {
        getAll: function (appId){
            return $http.get('/admin/api/pay_categories', {cache:true});
        }
    };
}]);
