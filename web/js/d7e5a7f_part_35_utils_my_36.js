smartApp.factory('Utils' ,  function () {
    return {
        getCSVFromObjectId: function (obj){

            var result='';
            angular.forEach(obj, function(item){

                result +=String(item.id) +',';
            });

            if (result.length> 1)
                result = result.substring(0, result.length -1);

            return result;

        },
        getArrayFromObjectId: function (obj){

            var result=[];
            angular.forEach(obj, function(item){

                result.push(item.id);
            });

            return result;
        },
        getCSVFromSelectedObjectsId: function (obj){

            var result='';
            angular.forEach(obj, function(item){
                if (item.selected)
                    result +=String(item.id) +',';
            });

            if (result.length> 1)
                result = result.substring(0, result.length -1);

            return result;
        },
        findStringById: function (obj, id, equal, result){
            var resultx;

            angular.forEach(obj, function(item){
                if (item[id] == equal)
                    resultx = item[result];
            });
            return resultx;
        },
        findObjectById: function (obj, id, equal){
            var resultx;
            angular.forEach(obj, function(item){
                if (item[id] == equal)
                    resultx = item;
            });
            return resultx;
        },
        selectAll: function(obj){
            angular.forEach(obj, function(item){
                item.selected=true;
            });
        },
        selectedRemoveAll: function(obj){
            angular.forEach(obj, function(item){
                item.selected=false;
            });
        },
        reselectPreviousSession1Level: function (obj1New, obj2Previous){

            if (!obj2Previous)
                return obj1New;

            angular.forEach(obj1New, function(newItem){
                angular.forEach(obj2Previous, function(previousItem){
                    if (newItem.id == previousItem.id && previousItem.selected)
                        newItem.selected = true;
                });
            });

            return obj1New;
        }
    };
});
