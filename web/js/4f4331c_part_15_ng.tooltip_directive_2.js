angular.module('shopApp').directive('tooltip',
    function(Device, $rootScope, $interval) {
        return {
            link : function(scope, element, attrs) {
                var timer ;

                if ($rootScope.device.hasMouse)
                {

                    $(element.parent().parent()).mousemove(function(e){

                        var $extraX = 0;

                        if (($( window ).width() / 2) + 50  <  e.pageX)
                            $extraX = -384;

                        $("#tooltip").css({
                            'top': (e.pageY + 20) + 'px',
                            'left': (e.pageX + 20  + $extraX)  +'px'
                        });
                    });

                    element.parent().parent().bind('mouseenter', function() {

                        function sync(){

                            if ($.trim($(element).html()))
                            {
                                $("#tooltip").html( $(element).html());
                                $("#tooltip").stop(true, true).delay(300).fadeIn();
                            }
                        }

                        sync();
                        timer = $interval(sync, 1000);

                    });

                    element.parent().parent().bind('mouseleave', function() {
                        $("#tooltip").stop(true, true).delay(100).fadeOut();
                        $interval.cancel(timer);
                    });

                }else{

                    $(element).siblings('.product-info-button').bind('click', function(e) {

                        $("#tooltip").html($(element).html());
                        var position = $(element).position();

                        var $extraX = 20;

                        if (($( window ).width() / 2) <  e.pageX)
                            $extraX = -324;

                        $("#tooltip").css({
                            'top': e.pageY - 15 + 'px',
                            'left': e.pageX + $extraX +'px'
                        });

                        $("#tooltip").stop(true, true).delay(100).toggle();

                        e.stopPropagation();
                    });
                }

            }
        };
    });