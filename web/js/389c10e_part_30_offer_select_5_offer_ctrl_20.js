smartApp.controller('OfferSelectOfferController', [ 'APIArticles', '$scope', '$rootScope', function (APIArticles, $scope, $rootScope) {
    APIArticles.getByFilters($rootScope.app.id).success(function(data){
        $scope.articles = data;

        angular.forEach($rootScope.offerCurrent.articles_extra, function(articleSelected, key) {
            angular.forEach(data, function(article) {
                if (article.id == articleSelected.id)
                    $rootScope.offerCurrent.articles_extra[key] = article;
            });
        });
    });
}]);
