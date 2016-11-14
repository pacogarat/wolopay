smartApp.factory('Utils' ,  function () {

    function splitDotsToGetObj(obj, key)
    {
        var keys = key.split('.'), val;

        for( var i=0; i < keys.length; i++ )
        {
//            console.log(obj, keys[i]);
            obj = obj[keys[i]];
        }

//        console.log('splitDotsToGetObj', key, obj);

        return obj;
    }
    return {
        generateId: function(length){
            length = length || 5;
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < length; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;

        },
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
            var resultx, v, item, valueT;
            for (var i = 0; i < obj.length; ++i) {
                item = obj[i];
                // multiple conditions
                if (id instanceof Array)
                {
                    v = true;
                    for (var ii = 0; ii < id.length; ++ii)
                    {
                        valueT = splitDotsToGetObj(item, id[ii]);


//                        console.log("SEARCHING", ii, id[ii], 'value', valueT,'currentv',equal[ii]);

                        if (valueT == equal[ii])
                        {
                            resultx = item;
//                            console.log("FOUND", ii, id[ii], valueT);
                        }
                        else
                            v = false;
                    }

                    if (resultx && v)
                        return resultx;
                }else{
                    if (item[id] == equal)
                        return item;
                }
            }

            return null;
        },
        findIndexById: function (obj, id, equal){
            var resultx, v, item, valueT;
            for (var i = 0; i < obj.length; ++i) {
                item = obj[i];
                // multiple conditions
                if (id instanceof Array)
                {
                    v = true;
                    for (var ii = 0; ii < id.length; ++ii)
                    {
                        valueT = splitDotsToGetObj(item, id[ii]);


//                        console.log("SEARCHING", ii, id[ii], 'value', valueT,'currentv',equal[ii]);

                        if (valueT == equal[ii])
                        {
                            resultx = item;
//                            console.log("FOUND", ii, id[ii], valueT);
                        }
                        else
                            v = false;
                    }

                    if (resultx && v)
                        return i;
                }else{
                    if (item[id] == equal)
                        return item;
                }
            }

            return null;
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
