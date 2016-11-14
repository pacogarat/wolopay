angular.module('shopApp').filter('find', function () {
    return {
        byId: function (obj1, obj2){
            for (var index in obj1) {
                if (obj1[index].id == obj2.id) {
                    return index;
                }
            }
            return -1;
        }
    };
});
