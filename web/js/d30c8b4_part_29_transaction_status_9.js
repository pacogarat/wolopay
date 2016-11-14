smartApp.filter('transaction_status',['localize', '$sce', function(localize, $sce) {
    return function(text, input) {
        text = parseInt(text);
        var textString, keyTranslation;

        if (text==1)
            keyTranslation= 'status_category.begin';
        else if (text ==25)
            keyTranslation= 'status_category.shopping';
        else if (text ==50)
            keyTranslation= 'status_category.processing';
        else if (text ==100)
            keyTranslation= 'status_category.pending';
        else if (text ==200)
            keyTranslation= 'status_category.completed';
        else if (text ==201)
            keyTranslation= 'status_category.subscription_active';
        else if (text ==500)
            keyTranslation= 'status_category.failed';
        else if (text ==700)
            keyTranslation= 'status_category.blocked';
        else if (text ==1000)
            keyTranslation= 'status_category.expired';


        if (text>=200 &&  text <300) {

            return $sce.trustAsHtml('<span class="label label-success" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }else if (text == 100){
            return $sce.trustAsHtml('<span class="label label-info" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }else if (text >= 300 && text < 1000){
            return $sce.trustAsHtml('<span class="label label-danger" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }else if (text >= 1000){
            return $sce.trustAsHtml('<span class="label label-warning" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }

        return $sce.trustAsHtml('<span data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
    }
}]);