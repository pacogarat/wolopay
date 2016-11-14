smartApp.factory('Flot' ,  function () {

    function colors(){
        return ["#7cb5ec", '#EE9A49', "#90ee7e", "#888888", "#aaeeee", "#eeaaee",
            "#337324", "#DF5353", "#aaeeee", "#6467e9", "#b71be7", "#00FF4E", "#4f966e", "#fe3673", "#995929",
            "#d39adb", "#ff0066", "#9e786f", "#09436e", "#4d3c26", "#ee7f71", "#363b55", "#b32ae4", "#ed92dc",
            "#b78346", "#fc894f", "#f6c283", "#ea4a2c", "#f6f2cf", "#48572e", "#c99451", "#19d0fd", "#908772",
            "#e47a22", "#edf83d", "#4ad6bc", "#f77dd7"
        ];
    }

    Highcharts.SparkLine = function (options, callback) {
        var defaultOptions = {
            chart: {
                renderTo: (options.chart && options.chart.renderTo) || this,
                backgroundColor: null,
                borderWidth: 0,
                type: 'area',
                margin: [2, 0, 2, 0],
                width: 120,
                height: 20,
                style: {
                    overflow: 'visible'
                },
                skipClone: true
            },
            title: {
                text: ''
            },
            credits: {
                enabled: false
            },
            xAxis: {
                labels: {
                    enabled: false
                },
                title: {
                    text: null
                },
                startOnTick: false,
                endOnTick: false,
                tickPositions: []
            },
            yAxis: {
                endOnTick: false,
                startOnTick: false,
                labels: {
                    enabled: false
                },
                title: {
                    text: null
                },
                tickPositions: [0]
            },
            legend: {
                enabled: false
            },
            tooltip: {
                shadow: false,
                useHTML: true,
                hideDelay: 0,
                shared: true,
                padding: 0,
                positioner: function (w, h, point) {
                    return { x: point.plotX - w / 2, y: point.plotY - h - 15};
                }
            },
            plotOptions: {
                series: {
                    animation: false,
                    lineWidth: 1,
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    marker: {
                        radius: 1,
                        states: {
                            hover: {
                                radius: 2
                            }
                        }
                    },
                    fillOpacity: 0.25
                },
                column: {
                    negativeColor: '#910000',
                    borderColor: 'silver'
                }
            }
        };
        options = Highcharts.merge(defaultOptions, options);

        return new Highcharts.Chart(options, callback);
    };

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
        parseArrayKey: function (obj, format, round){

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

                    }else if (format == 'not_title'){
                        result.push( Math.round(value * 100) / 100);
                        return;
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

        getPointRange: function (dateFormat){
            if (dateFormat == 'days')
                return 24 * 3600 * 1000;

            return null;
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
        sortDataPieCharts: function (series, customPropertie)
        {
            customPropertie = customPropertie || 'y';

            series.sort(function(obj1, obj2){
                if (obj1[customPropertie] < obj2[customPropertie])
                    return -1;

                if (obj1[customPropertie] > obj2[customPropertie])
                    return 1;

                return 0;
            });

            return series;
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