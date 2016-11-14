smartApp.factory('Flot' ,  function () {
    return {
        parseArrayKey: function (obj, format){

            var result = [], time;
            format = format || 'months';

            $.each(obj, function(key, value) {

                if (format == 'weeks')
            {
                    time = Date.UTC(parseInt(key.substring(0, 4)), 0, 1) + ((24*60*60*1000) * (parseInt(key.substring(5))*7));

                }else if (format == 'days')
                    time = Date.UTC(key.substring(0, 4), key.substring(5, 7)-1, key.substring(8, 10));
                else
                {
                    time = Date.UTC(key.substring(0, 4), key.substring(5, 7)-1);
                }


                result.push([time, value]);
            });


            return result;
        },
        parseArrayKeyText: function (obj, label, data){

            var result = [];

            $.each(obj, function(key, value) {
                result.push({label: value[label], data: parseInt(value[data])});
            });

            return result;
        },
        getColors: function ()
        {
            return ['#3276B1', '#71843F', '#BD0000', '#F5DB31', '#666666', '#EE9A49' , '#00F5FF', '#C6E2FF', '#98FB98', '#aa1dc8', '#ffa3ec', '#340ebb', '#ffffff', '#000000'];
        }
    };
});