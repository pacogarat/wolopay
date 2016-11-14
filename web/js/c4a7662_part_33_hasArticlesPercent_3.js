smartApp.filter('articleHasExtraOptions', ['$filter', function($filter) {
    return function(article) {

            if (article.n_purchases_total > 0 || article.n_purchases_per_client > 0 ||
                article.valid_from || article.valid_to || article.articles_extra.length > 0 ||
                (article.name_label && article.name_label.transaction_en ) ||
                (article.description_label && article.description_label.transaction_en ) ||
                (article.description_short_label && article.description_short_label.transaction_en)
                ){
                return true;
            }

            return false;
        ;
    }
}]);