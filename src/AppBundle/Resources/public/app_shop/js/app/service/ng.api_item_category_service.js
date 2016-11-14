angular.module('shopApp').factory('APIItemTab' , ['$http', 'routing' , '$rootScope', 'findObject', function ($http, routing, $rootScope, findObject) {
    return {
        getByAppId: function (appId, successCallBackOk){

            appId = appId || $rootScope.current.appId;
            successCallBackOk = successCallBackOk || function (data){};
            var url = routing.generate('item_tab_get_item_tabs',{app_id: appId, '_format' : 'json', 'IgnoreTranslations': 1});

            $http.get(url).success(
                function (data){

                    angular.forEach(data, function(row, index) {
                        row.selected = false;
                    });

                    $rootScope.current.itemTabs = data;

                    successCallBackOk(data);
                })
            ;

        }
    };
}]);
