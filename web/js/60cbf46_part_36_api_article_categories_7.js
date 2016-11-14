smartApp.factory('APIArticleCategories' , [ '$http', function ($http) {
    return {
        getAll: function (appId){
            return $http.get('/admin/api/article_categories', {cache:true});
        }
    };
}]);
