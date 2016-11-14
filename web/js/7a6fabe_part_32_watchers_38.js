smartApp.factory('Watchers', [ function () {

    return {
        formIsDirty: function (nameForm, scope, callback) {

            scope.$watch(nameForm+'.$dirty', function(newValue, oldValue) {
                if (newValue)
                    callback(newValue);
            });

        }
    };

}]);