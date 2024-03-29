smartApp.controller('ConfiguratorSelectItemController', [ 'APICountries', 'APILanguages', '$scope', 'APIItems', '$rootScope', 'Utils', '$filter', '$modal', 'dialogs', 'Watchers',
    function (APICountries, APILanguages, $scope, APIItems, $rootScope, Utils, $filter, $modal, dialogs, Watchers) {

    $rootScope.configuratorCurrent.items = [];

    Watchers.formIsDirty('form_items_global', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

    APIItems.getByAppId($rootScope.app.id).success(function (data){
        $rootScope.configuratorCurrent.items = data;
    });

    APILanguages.getAll($rootScope.app.id).success(function (data){
        $scope.languages = data;

        $scope.loadModal = function (item)
        {
            $scope.form_items_global.$setDirty(true);

            var modalInstance = $modal.open({
                controller: "ConfiguratorItemEditCtrl",
                templateUrl: 'item_mod.html',
                resolve: {
                    item: function()
                    {
                        return angular.copy(item);
                    },
                    languages: function()
                    {
                        return $scope.languages;
                    },
                    countries: function()
                    {
                        return $scope.countries;
                    }
                }
            });
        };
    });

    APICountries.getAll().success(function(data){
        $scope.countries=data;
    });

    $scope.delete = function (item) {
        $scope.form_items_global.$setDirty(true);

        APIItems.deleteById(item.id).success(function (data){
            $rootScope.configuratorCurrent.items.splice( $rootScope.configuratorCurrent.items.indexOf(item), 1 );
        });
    };

}]).controller('ConfiguratorItemEditCtrl', ['countries', 'languages', '$scope', '$modalInstance', 'item', 'alerts', '$rootScope', 'APIItems', 'Watchers',
        function (countries, languages, $scope, $modalInstance, item, alerts, $rootScope, APIItems, Watchers)
{
    $scope.item = item;
    $scope.languages = languages;
    $scope.countries = countries;

    $scope.not_number = false;
    $scope.searchIfContainsNumber = function () {

        $scope.not_number = false;

        angular.forEach(languages, function(lang) {
            if (item.name_label && 'translation_'+ lang.id in item.name_label && item.name_label['translation_'+ lang.id ].indexOf("{[{number}]}") == -1)
                $scope.not_number = true;
        });
    };

    if ((!item || !item.id) && localStorage.getItem('unitary_price_country'))
    {
        item.unitary_price_country = JSON.parse(localStorage.getItem('unitary_price_country'));
    }

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.uploadComplete  = function (content){

        if (content.id)
        {
            localStorage.setItem('unitary_price_country', JSON.stringify(item.unitary_price_country));

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

