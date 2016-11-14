smartApp.factory('RowsCalculator', [ function () {

    return {
        getByScreenHeight: function () {
            return screen.height / 35;
        }
    };

}]);