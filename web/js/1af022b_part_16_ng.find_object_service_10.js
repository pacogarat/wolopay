shopApp.factory('findObject', function () {
    return {
        byObjId: function (obj1, obj2){
            for (var index in obj1) {
                if (obj1[index].id == obj2.id) {
                    return index;
                }
            }
            return -1;
        },
        byId: function (obj1, id){
            for (var index in obj1) {
                if (obj1[index].id == id) {
                    return index;
                }
            }
            return -1;
        }
    };
});
