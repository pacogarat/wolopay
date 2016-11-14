smartApp.factory('Flot' ,  function () {

    function colors(){
        return ["#7cb5ec", "#eeeeee", "#f7a35c", "#90ee7e", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
            "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"];
    }

    Highcharts.theme = {
        colors: colors(),
        tooltip: {
            borderColor: '#bbbbbb',
            backgroundColor: 'rgba(250, 250, 250, 0.95)',
            borderWidth: 2
        }
    };

    // Apply the theme
    Highcharts.setOptions(Highcharts.theme);

    function leftPad(number, targetLength) {
        var output = number + '';
        while (output.length < targetLength) {
            output = '0' + output;
        }
        return output;
    }

    return {
        getArrayIntHours: function (begin, end){
            var result = [];
            for (var i = begin; i<end; i++ )
                result.push(leftPad(i, 2));

            console.log("WEE", result);

            return result;
        },
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


                result.push([time, Math.round(value * 100) / 100]);
            });


            return result;
        },
        parseArrayKeyText: function (obj){

            var result = [];

            $.each(obj, function(key, value) {
                result.push([key, value]);
            });

            return result;
        },
        getColors: colors
    };
});