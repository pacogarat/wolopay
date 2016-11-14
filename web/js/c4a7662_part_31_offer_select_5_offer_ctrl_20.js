smartApp.controller('OfferSelectOfferController', [ 'APIArticles', '$scope', '$rootScope', function (APIArticles, $scope, $rootScope) {
    APIArticles.getByFilters($rootScope.app.id).success(function(data){
        $scope.articles = data;
    });
}]);
