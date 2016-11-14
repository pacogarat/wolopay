// Routing is external provided by FosJsBundle

angular.module('shopApp').factory('ArticleHelper', function () {

    return {
        getArticleIdsCSV: function (appShopHasArticles) {
            var article_ids = '';
            for (var i = 0; i < appShopHasArticles.length; i++) {
                article_ids += appShopHasArticles[i].article.id+',';
            }
            article_ids = article_ids.slice(0, -1);
            return article_ids;
        }

    };
});