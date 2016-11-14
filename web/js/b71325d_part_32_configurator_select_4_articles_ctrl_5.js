smartApp.controller('ConfiguratorSelectArticlesController', ['$scope', 'APIItems', '$rootScope', 'Utils', '$filter', '$modal', 'dialogs', 'Watchers',
        function ($scope, APIItems, $rootScope, Utils, $filter, $modal, dialogs, Watchers) {

            $rootScope.configuratorCurrent.items = {};
            Watchers.formIsDirty('form_articles_global', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

            APIItems.getByAppId($rootScope.app.id).success(function (data){
                $rootScope.configuratorCurrent.items = data;
            });

            $scope.loadModal = function (item)
            {
                $scope.form_articles_global.$setDirty(true);
                var modalInstance = $modal.open({
                    controller: "ConfiguratorArticleEditCtrl",
                    templateUrl: 'article_mod.html',
                    backdrop: 'static',
                    windowClass: 'full',
                    resolve: {
                        item: function()
                        {
                            return item;
                        }
                    }
                });
            };

    }]).controller('ConfiguratorArticleEditCtrl', ['$scope', '$modalInstance', 'item', 'alerts', '$rootScope', 'APIItems',
        function ($scope, $modalInstance, item, alerts, $rootScope, APIItems)
        {
            $scope.item = angular.copy(item);


            $scope.cancel = function () {
                $modalInstance.dismiss('cancel');
            };

            $scope.addArticle = function (){
                $scope.item.articles.push({});
            };

            $scope.delete = function (article){
                $scope.item.articles.splice( $scope.item.articles.indexOf(article), 1 );
            };

            $scope.calculateDiscount = function (item, article){
                if (article.article_category && article.article_category.id == 'free')
                    article.discount = -100;
                else
                    article.discount= ((article.amount_standard / article.items_quantity) * 100 / item.unitary_price ) - 100;
            };

            $scope.uploadComplete = function (content){

                if (content.id)
                {
                    APIItems.getByAppId($rootScope.app.id).success(function (data){
                        $rootScope.configuratorCurrent.items = data;
                    });
                    $modalInstance.dismiss('cancel');

                }else if (typeof content == 'object'){
                    alerts.addError(content.message);
                }else{
                    alerts.addError('internal_server_error');
                }

                $rootScope.loading = false;
            };
}]);
