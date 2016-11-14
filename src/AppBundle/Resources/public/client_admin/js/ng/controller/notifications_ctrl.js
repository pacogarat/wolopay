smartApp.controller('NotificationsController',['$scope', 'APINotifications', '$modal', '$rootScope', '$filter', '$routeParams', 'CommonFTransPurchNot', 'LoadMoreScroll',
    function ($scope, APINotifications, $modal, $rootScope, $filter, $routeParams, CommonFTransPurchNot, LoadMoreScroll) {

    var loadMoreScrollHandler = null;
    CommonFTransPurchNot.removeDateWhenChangeSearch($scope);

    $scope.currentPage = 0;
    $scope.search = $routeParams;
    $scope.notifications = [];
    $scope.maxCurrentPage = false;
    $scope.thereAreData = null;

    var exe = function exe(callback ){

        callback = callback || function(){};
        LoadMoreScroll.clear(loadMoreScrollHandler);

        APINotifications.getAll(null, null, null, null, $scope.currentPage, $scope.search.purchase_notification_id,
                $scope.search.purchase_id, $scope.search.transaction_id, $scope.search.gamer_external_id,
                $scope.search.was_received, $scope.search.subscription_id
        ).success(function (data){

            $scope.notifications=$.merge($scope.notifications, data);

            if (data.length > 0)
            {
                $scope.notif_articles = $filter('unique_with_array_children')($scope.notifications, 'payment_detail_has_article');
                $scope.notif_gamer = $filter('unique_with_array_children')($scope.notifications, 'purchases');
                $scope.notif_attempts = $filter('unique')($scope.notifications, 'attempts');

                $scope.currentPage++;
            }

            if (data.length == 0)
            {
                $scope.maxCurrentPage = true;
            }else{
                loadMoreScrollHandler = LoadMoreScroll.onScroll(function(callback ){ exe(callback ); });
            }

            $scope.thereAreData = $scope.notifications.length > 0;
            callback();

        });
    };

    exe();

    $scope.forceResend = function (purchaseNotification){
        APINotifications.resend(null, purchaseNotification.id).success(function(data){
            if (data.response.http_code >= 200 && data.response.http_code < 300)
                purchaseNotification.was_received = true;
            else
                purchaseNotification.was_received = false;

            purchaseNotification.requests.push(data);

            var modalInstance = $modal.open({
                controller: "NotificationResendInformModalCtrl",
                templateUrl: 'notificationResendInformModal.html',
                resolve: {
                    notification: function(){
                        return purchaseNotification;
                    },
                    sentInfo: function(){
                        return data;
                    }
                }
            });
        });
    };




    $scope.loadSearch = function(){
        $scope.notifications = [];
        $scope.currentPage = 0;
        $scope.maxCurrentPage = false;
        exe();
    };

    $scope.predicate = 'created_at';
    $scope.reverse=true;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl2",
            templateUrl: 'myModalContent.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };


        function resetCurrentPage()
        {
            $scope.currentPage = 0;
            $scope.notifications = [];
            $scope.maxCurrentPage = false;
            exe();
        }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        $rootScope.watcherWithTimeOut(newValue, oldValue, resetCurrentPage);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
        LoadMoreScroll.clear(loadMoreScrollHandler);
    });
}]);

smartApp.controller('NotificationModalCtrl2', ['$scope', '$modalInstance', 'notification', function ($scope, $modalInstance, notification){
    $scope.notification = notification;
    $scope.copyToClipboard2 = function (elem1){
        // create hidden text element, if it doesn't already exist
        elem = document.getElementById(elem1);
        var targetId = "_hiddenCopyText_";
        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
        var origSelectionStart, origSelectionEnd;
        if (isInput) {
            // can just use the original source element for the selection and copy
            target = elem;
            origSelectionStart = elem.selectionStart;
            origSelectionEnd = elem.selectionEnd;
        } else {
            // must use a temporary form element for the selection and copy
            target = document.getElementById(targetId);
            if (!target) {
                var target = document.createElement("textarea");
                target.style.position = "absolute";
                target.style.left = "-9999px";
                target.style.top = "0";
                target.id = targetId;
                document.body.appendChild(target);
            }
            target.textContent = elem.textContent;

        }
        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        var succeed;
        try {
            succeed = document.execCommand("copy");
        } catch(e) {
            succeed = false;
        }
        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        if (isInput) {
            // restore prior selection
            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
        } else {
            // clear temporary content
            target.textContent = "";
        }
        return succeed;
    };

}]);

smartApp.controller('NotificationResendInformModalCtrl', ['sentInfo', '$scope', '$modalInstance', 'notification', function (sentInfo, $scope, $modalInstance, notification){
    $scope.notification = notification;
    $scope.sentInfo = sentInfo;
}]);