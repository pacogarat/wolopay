smartApp.directive('datepick', function() {
    return {
        restrict: 'A',
        require : 'ngModel',
        link : function (scope, element, attrs, ngModelCtrl) {
            var maxDate, minDate;
            if (attrs.maxDate)
                maxDate = $( attrs.maxDate );
            if (attrs.minDate)
                minDate = $( attrs.minDate );


            function getDate(queryDate)
            {
                var dateParts = queryDate.match(/(\d+)/g);
                return  new Date(dateParts[0], dateParts[1] -1, dateParts[2], 0, 0, 0);
            }

            function isSameDay(dateToCheck, actualDate)
            {
                return (dateToCheck.getDate() == actualDate.getDate()
                    && dateToCheck.getMonth() == actualDate.getMonth()
                    && dateToCheck.getFullYear() == actualDate.getFullYear());
            }

            $(function(){
                element.datepicker({
                    dateFormat:'yy-mm-dd',
                    firstDay: 1 ,
                    numberOfMonths: 1,
                    beforeShowDay: function(date) {


                        // check if date is in your array of dates
                        var maxDateVal,minDateVal;
                        if (maxDate){
                            maxDateVal=getDate(maxDate.val())
                        }
                        if (minDate){
                            minDateVal=getDate(minDate.val())
                        }
                        if((maxDate && isSameDay(date, maxDateVal)) || (minDate && isSameDay(date, minDateVal))) {
                            return [true, 'css-class-to-highlight',null];
                        } else {

                            return [true, '', ''];
                        }
                    },
                    onClose: function( selectedDate ) {
                        if (maxDate)
                            maxDate.datepicker( "option", "minDate", selectedDate );

                        if (minDate)
                            minDate.datepicker( "option", "maxDate", selectedDate );

                    },
                    onSelect:function (date) {
                        scope.$apply(function () {
                            ngModelCtrl.$setViewValue(date);
                        });
                    }
                });

                if (maxDate)
                    element.datepicker( "option", "maxDate", maxDate.val() );

                if (minDate)
                    element.datepicker( "option", "minDate", minDate.val() );


            });
        }
    }
});