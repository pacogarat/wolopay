smartApp.factory('CsvUtil', [function () {

    var csvContent = 'data:text/csv;charset=utf-8,', temp = [];

    function addToCsvContent(arr)
    {
        csvContent += arr.join(",") + "\n";
    }

    return {
        insertTextAndCleanTemp: function () {
            addToCsvContent(temp);
            temp=[];
        },
        addToTemp: function (data, type)
        {
            if (data == undefined)
                data = null;
                    

            if (type=='num' || type=='%')
            {
                if (data)
                    data = parseFloat(Math.round(data * 100) / 100).toFixed(2);
            }

            if (type=='%')
            {
                if (data)
                    data = data +'%';
            }

            data = data || '';

            temp.push('"'+data+'"');
        },
        downloadAndReset: function (nameFile) {
            nameFile = nameFile || "my_data.csv";
            var link = document.createElement("a");
            link.setAttribute("href", encodeURI(csvContent));
            link.setAttribute("download", nameFile);

            link.click();

            csvContent = 'data:text/csv;charset=utf-8,';
        }

    };
}]);