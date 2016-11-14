smartApp.directive('purchaseStatus', ['$compile', function ($compile) {

    return {
        restrict: 'AE',
        link: function(scope, element, attrs) {

            var text = attrs.state;
            var textString, keyTranslation='';
            var className = '';

            if (text=="free") {
                keyTranslation = 'purchase_status.free';
                className = 'fa fa-circle-o';
            }else if (text =="single_payment") {
                keyTranslation = 'purchase_status.single_payment';
                className = 'fa fa-check-circle-o';
            }else if (text =="new_subscription") {
                keyTranslation = 'purchase_status.new_subscription';
                className = 'fa fa-recycle';
            }else if (text =="subscription_renewal") {
                keyTranslation = 'purchase_status.subscription_renewal';
                className = 'fa fa-refresh';
            }

            element.html('<span data-tooltip="{[{\''+keyTranslation+'\' | translate }]}"><i class="'+ className +'"></i></span>');
            $compile(element.contents())(scope);
        }
    };
}]);