smartApp.filter("csv", [ 'Utils', function(Utils){
    return function(str){

        if (!str)
            return '';

        return Utils.getCSVFromObjectId(str);
    }
}
]);