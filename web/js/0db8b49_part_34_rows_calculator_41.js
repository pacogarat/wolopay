smartApp.factory('RowsCalculator', [ function () {

    return {
        getByScreenHeight: function () {
            return Math.round(screen.height / 35);
        }
    };

}]);