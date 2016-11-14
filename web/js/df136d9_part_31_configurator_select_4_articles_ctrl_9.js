smartApp.controller('ConfiguratorSelectArticlesController', ['$scope', 'APIItems', '$rootScope', 'Utils', '$filter', '$modal', 'dialogs', 'Watchers', 'APILanguages', 'APIArticles',
        function ($scope, APIItems, $rootScope, Utils, $filter, $modal, dialogs, Watchers, APILanguages, APIArticles) {

            $scope.searchText = {};
            $scope.searchTextGacha = {};
            $scope.tabSelected = 1;

            $scope.$on("$destroy", function() {
                delete $rootScope.formatItems;
                delete $rootScope.configuratorCurrent.items;
            });

            APILanguages.getAll($rootScope.app.id).success(function (data){
                $scope.languages = data;
            });

            function searchArticleByArticleId(articleId)
            {
                var result= null;
                angular.forEach($rootScope.configuratorCurrent.items, function(it){
                    angular.forEach(it.articles, function (arti){
                        if (arti.id == articleId)
                            result = arti;
                    });
                });

                return result;
            }

            $scope.deleteArticle = function (item, article)
            {
                APIArticles.deleteByAppIdAndArticleId($rootScope.app.id, article.id).success(function(){
                    $rootScope.removeItemFromCollection(article, item.articles);
                });

            };

            $rootScope.formatItems = function(items)
            {
                var arr ;
                angular.forEach(items, function(it){
                    angular.forEach(it.articles, function (arti){
                        arr = [];
                        angular.forEach(arti.articles_extra, function (artiExtra){
                            arr.push(searchArticleByArticleId(artiExtra.id));
                        });
                        arti.articles_extra = arr;
                    });
                });

            };

            $rootScope.configuratorCurrent.items = {};
            Watchers.formIsDirty('form_articles_global', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

            APIItems.getByAppId($rootScope.app.id).success(function (data){
                $rootScope.configuratorCurrent.items = data;
                $rootScope.formatItems(data);
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
                        },
                        languages: function(){
                            return $scope.languages;
                        }
                    }
                });
            };

            $scope.addGacha = function (item, article)
            {
                $scope.form_articles_global.$setDirty(true);
                var modalInstance = $modal.open({
                    controller: "ConfiguratorArticleGachaCtrl",
                    templateUrl: 'article_gacha_mod.html',
                    resolve: {
                        item: function(){
                            return item;
                        },
                        languages: function(){
                            return $scope.languages;
                        },
                        article: function(){
                            return angular.copy(article);
                        }
                    }
                });
            };

            $rootScope.hasExtraOptions = function (article)
            {
                if (article.n_purchases_total > 0 || article.n_purchases_per_client > 0 ||
                    article.valid_from || article.valid_to || article.articles_extra.length > 0 ||
                    (article.name_label_original && article.name_label_original.translation_en ) ||
                    (article.description_label_original && article.description_label_original.translation_en ) ||
                    (article.description_short_label_original && article.description_short_label_original.translation_en) ||
                    (article.image_original && article.image_original.img)
                    ){
                    return true;
                }

                return false;
            };

    }]).controller('ConfiguratorArticleEditCtrl', ['$scope', '$modalInstance', '$modal', 'item', 'alerts', '$rootScope', 'APIItems', 'languages',
        function ($scope, $modalInstance, $modal, item, alerts, $rootScope, APIItems, languages)
        {
            $scope.languages = languages;

            $scope.item = angular.copy(item);

            $scope.cancel = function () {
                $modalInstance.dismiss('cancel');
            };

            $scope.addArticle = function (){
                $scope.item.articles.push({articles_extra: []});
            };

            $scope.delete = function (article){
                $scope.item.articles.splice( $scope.item.articles.indexOf(article), 1 );
            };

            $scope.calculatePriceInit = function (item, article)
            {
                article.amount_standard = Math.round(item.unitary_price * article.items_quantity * 100) / 100;
                $scope.calculateDiscount(item, article);
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
                        $rootScope.formatItems(data);
                    });
                    $modalInstance.dismiss('cancel');

                }else if (typeof content == 'object'){
                    alerts.addError(content.message);
                }else{
                    alerts.addError('internal_server_error');
                }

                $rootScope.loading = false;
            };

            $scope.loadModalExtraOpts = function (item, article, index)
            {
                var modalInstance = $modal.open({
                    controller: "ConfiguratorArticleExtraOptsEditCtrl",
                    templateUrl: 'article_extra_options_mod.html',
                    backdrop: 'static',
                    resolve: {
                        item: function(){
                            return item;
                        },
                        article: function(){
                            return article;
                        },
                        index: function(){
                            return index;
                        },
                        languages: function(){
                            return $scope.languages;
                        }
                    }
                });
            };
}]).controller('ConfiguratorArticleExtraOptsEditCtrl', ['$scope', '$modalInstance', 'alerts', '$rootScope', 'APIItems', 'article', 'item', 'index', 'languages',
    function ($scope, $modalInstance, alerts, $rootScope, APIItems, article, item, index, languages)
    {
        $scope.item = item;
        var articleCopy = angular.copy(article);

        if (articleCopy.valid_from)
            articleCopy.valid_from = moment(articleCopy.valid_from).toDate();

        if (articleCopy.valid_to)
            articleCopy.valid_to = moment(articleCopy.valid_to).toDate();

        $scope.article = articleCopy;
        $scope.languages = languages;
        $scope.file_updated = false;
        $scope.file_deleted = false;

        function searchItemByArticleId(articleId)
        {
            var result= null;
            angular.forEach($rootScope.configuratorCurrent.items, function(it){
                angular.forEach(it.articles, function (arti){
                    if (arti.id == articleId)
                        result = it;
                });
            });

            return result;
        }

        function findIfItemIdIsInside(itemId)
        {
            var exist = false;

            angular.forEach($scope.article.articles_extra, function(article){
                itemExtra = searchItemByArticleId(article.id);
                if (itemExtra.id == itemId)
                    exist = true;
            });

            return exist;
        }


        $scope.calculateArticles = function(){

            var articles = [];
            angular.forEach($rootScope.configuratorCurrent.items, function(it){
                angular.forEach(it.articles, function (arti){

                    if (arti.article_category.id == article.article_category.id && it.id != item.id)
                    {
                        if (!$scope.article.articles_extra || $scope.article.articles_extra.indexOf(arti.id) != '-1' || !findIfItemIdIsInside(it.id))
                            articles.push(arti);
                    }
                });
            });

            $scope.articles = articles;
        };

        $scope.calculateArticles();
        $scope.$watch('article', function (newVal, oldVal) {

            if (oldVal.articles_extra.length == newVal.articles_extra.length)
                return;
            $scope.calculateArticles();
        }, true);

        $scope.imageRemoved = function(){
            $scope.file_updated = false;
            $scope.file_deleted = true;
            $scope.article.image_original.img = null
        };

        $scope.ok = function () {

            article.name_label_original = $scope.article.name_label_original;
            article.description_label_original = $scope.article.description_label_original;
            article.description_short_label_original = $scope.article.description_short_label_original;
            article.valid_from = $scope.article.valid_from || null;
            article.valid_to = $scope.article.valid_to || null;
            article.n_purchases_per_client = $scope.article.n_purchases_per_client;
            article.n_purchases_total = $scope.article.n_purchases_total;
            article.articles_extra = $scope.article.articles_extra;
            article.show_when_stock_under_n = $scope.article.show_when_stock_under_n;

            if ($scope.file_updated)
            {
                article.image_original = $scope.article.image_original;

                var temp = [];
                angular.forEach($scope.article.extra_articles, function(article){
                    temp.push(article);
                });
                $scope.article.extra_articles = temp;

                var clone = $('#file_img_override').detach();
                clone.attr('id', '');
                clone.attr('name', 'file_'+index);
                clone.attr('onchange', '');
//                clone.hide();
                $('#file_container_'+index).html(clone);
//                $('#file_container_'+index).html(clone);

                article.file_deleted = false;
            }

            if ($scope.file_deleted)
            {
                article.image_original = $scope.article.image_original;
                article.file_deleted = true;
                $('#file_container_'+index).html('');
            }

            $modalInstance.close();

        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };

        $scope.fileChanged = function(){

            if (!$scope.article.image_original)
                $scope.article.image_original = {};

            $scope.article.image_original.img = 'changed';
            $scope.file_updated = true;
            $scope.file_deleted = false;
        };
    }
])
.controller('ConfiguratorArticleGachaCtrl', ['$scope', '$modalInstance', 'alerts', '$rootScope', 'APIItems', 'languages', 'APIArticles', 'item', 'article',
    function ($scope, $modalInstance, alerts, $rootScope, APIItems, languages, APIArticles, item, article)
    {
        $scope.languages = languages;
        $scope.articles=[];
        $scope.item=item;
        $scope.file_deleted = false;

        $scope.sortableOptions = {
            handle: '.move'
        };

        $scope.articlesNotUsed = function(article)
        {
            var result = [], flag;

            for (var i = 0; i < $scope.articles.length; i++)
            {
                flag = false;

                for (var ii = 0; ii < $scope.article.articles_gacha.length; ii++)
                {
                    if ($scope.article.articles_gacha[ii].possible_article &&
                        (!article || article.id != $scope.article.articles_gacha[ii].possible_article.id)
                        && $scope.article.articles_gacha[ii].possible_article.id == $scope.articles[i].id)
                    {
                        flag= true;
                        break;
                    }
                }

                if (!flag)
                    result.push($scope.articles[i]);
            }

            return result;
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };


        if (!article)
        {
            $scope.article = {
                item: item,
                articles_gacha: [{
                    order: 0,
                    amount_to_give: 10
                }]
            };
        }else{

            if (article.valid_to)
                article.valid_to = new Date(article.valid_to);

            if (article.valid_from)
                article.valid_from= new Date(article.valid_from);

            $scope.article = article;
        }

        $scope.addArticleToGacha = function(){
            $scope.article.articles_gacha.push({
                order: 0,
                amount_to_give: 10
            })
        };

        APIArticles.getByFilters($rootScope.app.id, null, null, null, null, null, 'null').success(function (data){

            if (article && article.articles_gacha && article.articles_gacha.length > 0)
            {
                for (var i = 0; i < article.articles_gacha.length; i++)
                {
                    for (var ii = 0; ii < data.length; ii++)
                    {
                        if (article.articles_gacha[i].possible_article.id == data[ii].id)
                        {
                            article.articles_gacha[i].possible_article = data[ii];
                            break;
                        }
                    }
                }
            }

            $scope.articles = data;
        });


        $scope.uploadComplete = function (content){

            if (content.id)
            {
                APIItems.getByAppId($rootScope.app.id).success(function (data){
                    $rootScope.configuratorCurrent.items = data;
                    $rootScope.formatItems(data);
                });
                $modalInstance.dismiss('cancel');

            }else if (typeof content == 'object'){
                alerts.addError(content.message);
            }else{
                alerts.addError('internal_server_error');
            }

            $rootScope.loading = false;
        };

        $scope.imageRemoved = function(){
            $scope.file_updated = false;
            $scope.file_deleted = true;
            $scope.article.image_original = null
        };

        $scope.fileChanged = function(){

            if (!$scope.article.image_original)
                $scope.article.image_original = {};

            $scope.article.image_original.img = 'changed';
            $scope.file_updated = true;
            $scope.file_deleted = false;
        };
    }
]);