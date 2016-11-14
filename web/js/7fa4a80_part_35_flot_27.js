smartApp.factory('Flot' ,  function () {

    function colors(){
        return ["#7cb5ec", '#EE9A49', "#90ee7e", "#888888", "#aaeeee", "#7798BF", "#ff0066", "#eeaaee",
            "#55BF3B", "#DF5353", "#7798BF", "#aaeeee", "#6467e9", "#b71be7", "#3add6c", "#4f966e", "#fe3673", "#995929",
            "#d39adb", "#9e786f", "#09436e"
        ];
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

            return result;
        },
        parseArrayKey: function (obj, format){

            var result = [], time;
            format = format || 'months';

            $.each(obj, function(parentKey, parentValue) {

                $.each(parentValue, function(key, value) {

                    if (format == 'weeks')
                    {
                        time = Date.UTC(parseInt(key.substring(0, 4)), 0, 1) + ((24*60*60*1000) * (parseInt(key.substring(5))*7));

                    }else if (format == 'days'){

                        time = Date.UTC(key.substring(0, 4), key.substring(5, 7)-1, key.substring(8, 10));
                    }else if (format == 'hours' || format == 'static'){
                        time = key;
                    }else{
                        time = Date.UTC(key.substring(0, 4), key.substring(5, 7)-1);
                    }


                    result.push([time, Math.round(value * 100) / 100]);
                });
            });


            return result;
        },
        parseArrayKeyText: function (obj){

            var result = [];

            $.each(obj, function(key, value) {
                result.push([key, Math.round(value * 100) / 100]);
            });

            return result;
        },
        getXAxisFormatTime: function (dateFormat){
            if (dateFormat == 'hours')
                return { categories: this.getArrayIntHours() };
            else if (dateFormat == 'weeks' )
                xAxisFormat = { week: '%e %b week' };
            else if (dateFormat == 'months' )
                xAxisFormat = { month: '%b' };
            else
                xAxisFormat = { day: '%e. %b'};

            return {
                type: 'datetime' ,
                dateTimeLabelFormats: xAxisFormat
            };
        },
        getKeys: function (obj, prefix, suffix){

            var result = [];
            suffix = suffix || '';
            prefix = prefix || '';

            $.each(obj, function(keyParent, valueParent) {
                $.each(valueParent, function(key, value) {
                    result.push(prefix+key+suffix);
                });
            });

            return result;
        },
        getColors: colors,
        increaseBrightness: function(hex, percent){
            // strip the leading # if it's there
            hex = hex.replace(/^\s*#|\s*$/g, '');

            // convert 3 char codes --> 6, e.g. `E0F` --> `EE00FF`
            if(hex.length == 3){
                hex = hex.replace(/(.)/g, '$1$1');
            }

            var r = parseInt(hex.substr(0, 2), 16),
                g = parseInt(hex.substr(2, 2), 16),
                b = parseInt(hex.substr(4, 2), 16);

            return '#' +
                ((0|(1<<8) + r + (256 - r) * percent / 100).toString(16)).substr(1) +
                ((0|(1<<8) + g + (256 - g) * percent / 100).toString(16)).substr(1) +
                ((0|(1<<8) + b + (256 - b) * percent / 100).toString(16)).substr(1);
        }
    };
});