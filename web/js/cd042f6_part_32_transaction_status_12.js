smartApp.directive('transactionStatus', ['$compile', function ($compile) {
    return {
        restrict: 'AE',
        link: function(scope, element, attrs) {

            text = parseInt(attrs.state);
            var textString, keyTranslation='';

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
            else if (text == 800)
                keyTranslation= 'status_category.blacklisted_country';
            else if (text == 801)
                keyTranslation= 'status_category.blacklisted_gamer';
            else if (text == 802)
                keyTranslation= 'status_category.blacklisted_ip';
            else if (text ==1000)
                keyTranslation= 'status_category.expired';

            var className = '';

            if (text>=200 &&  text <300) {

                className = 'label label-success';
            }else if (text == 100){
                className = 'label label-danger';
            }else if (text >= 300 && text < 1000){
                className = 'label label-danger';
            }else if (text >= 1000){
                className = 'label label-warning';
            }

            element.html('<span class="'+className+'" data-translate="'+keyTranslation+'"></span>');
            $compile(element.contents())(scope);
        }
    };
}]);