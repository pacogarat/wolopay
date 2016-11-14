smartApp.controller('ConfiguratorSelectItemController', [ 'APICountries', 'APILanguages', '$scope', 'APIItems', '$rootScope', 'Utils', '$filter', '$modal', 'dialogs', 'Watchers', 'APIItemTabs', '$http',
    function (APICountries, APILanguages, $scope, APIItems, $rootScope, Utils, $filter, $modal, dialogs, Watchers, APIItemTabs, $http) {

        $scope.searchText = {};
        $rootScope.configuratorCurrent.items = [];

        $scope.sortableOptions = {
            handle: '.move'
        };

        var itemTabSync = function(callback)
        {
            callback = callback || function(){};
            $http.post('/admin/api/app/'+$rootScope.app.id+'/item_tab/sync', {itemTabs: $scope.itemTabs}).success(function(data) {
                $scope.itemTabs = data;
                callback(data);
            });
        };

        $scope.next = function(){
            itemTabSync(function(){$rootScope.configuratorCurrent.step = 4});
        };

        function generateUniqueName(name)
        {
            return name.replace(' ', '_').toLowerCase().substring(0, 45);
        }

        $scope.validateIsUniqueName = function(category)
        {
            angular.forEach($scope.itemTabs, function(obj){
                obj.name_unique = generateUniqueName(obj.name);
            });

            var valid = true;
            angular.forEach($scope.itemTabs, function(obj){
                if (category.name_unique == obj.name_unique && obj !== category)
                    valid = false;
            });

            return valid;
        };

        $scope.addItemTab = function(){
            var newObject = {};
            $scope.itemTabs.push(newObject);
        };

        $scope.uploadImage = function(category)
        {
            $modal.open({
                controller: "AppTabUpLoadCtrl",
                templateUrl: 'item_tab_image.html',
                resolve: {
                    appTab: function()
                    {
                        return category;
                    }
                }
            });
        };

        $scope.deleteImage = function (itemTab){

            $http.delete('/admin/api/app/'+$rootScope.app.id+'/item_tab/'+itemTab.id+'/photo').success(function() {
                itemTab.image.img = null;
            });
        };

        Watchers.formIsDirty('form_items_global', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

        function getItems()
        {
            APIItems.getByAppId($rootScope.app.id).success(function (data){

                var findOriginalObject = function(id){
                    for (var i = 0; i < $scope.itemTabs.length; i++) {
                        if ($scope.itemTabs[i].id == id)
                            return $scope.itemTabs[i];
                    }
                    return null;
                };

                // sync objects
                angular.forEach(data, function(dat) {
                    for (var i = 0; i < dat.item_tabs.length; i++) {
                        dat.item_tabs[i]=findOriginalObject(dat.item_tabs[i].id);
                    }
                });

                $rootScope.configuratorCurrent.items = data;
            });
        }


        APIItemTabs.getByAppId($rootScope.app.id).success(function (data){
            $scope.itemTabs = data;

            getItems();
        });



        APILanguages.getAll($rootScope.app.id).success(function (data){
            $scope.languages = data;

            $scope.loadModal = function (item)
            {
                $scope.form_items_global.$setDirty(true);
                itemTabSync();

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
                        },
                        itemTabs: function()
                        {
                            return $scope.itemTabs;
                        },
                        onFinishOk: function()
                        {
                            return getItems;
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

        $scope.removeItemTab = function(itemTab){

            angular.forEach($scope.itemTabs, function(obj, index){
                if (obj === itemTab)
                    $scope.itemTabs.splice(index, 1);
            });

        };

}]).controller('ConfiguratorItemEditCtrl', ['countries', 'languages', '$scope', '$modalInstance', 'item', 'alerts', '$rootScope', 'APIItems', 'Watchers', 'itemTabs', 'onFinishOk',
        function (countries, languages, $scope, $modalInstance, item, alerts, $rootScope, APIItems, Watchers, itemTabs, onFinishOk)
{
    if (!item.special_type || !item.special_type.id)
        item.special_type = {id: 'normal'};

    $scope.item = item;
    $scope.languages = languages;
    $scope.countries = countries;
    $scope.itemTabs = itemTabs;

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

            onFinishOk();
            $modalInstance.dismiss('cancel');

        }else if (typeof content == 'object'){
            alerts.addError(content.message);
        }else{
            alerts.addError('internal_server_error');
        }
        $rootScope.loading = false;
    };


}]);

