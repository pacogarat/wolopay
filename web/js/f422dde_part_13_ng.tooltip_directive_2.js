shopApp.directive('tooltip',
    function(Device, $rootScope, $interval) {
        return {
            link : function(scope, element, attrs) {
                var timer ;
                if (Device.hasMouse())
                {
                    $(element.parent()).mousemove(function(e){
                        $("#tooltip").css({
                            'top': e.pageY + 10 + 'px',
                            'left': e.pageX + 10 +'px'
                        });
                    });

                    element.parent().bind('mouseenter', function() {

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

                    element.parent().bind('mouseleave', function() {
                        $("#tooltip").stop(true, true).delay(100).fadeOut();
                        $interval.cancel(timer);
                    });

                }else{

                    $(element).siblings('.product-info-button').bind('click', function(e) {
                        $("#tooltip").html($(element).html());
                        var position = $(element).position();

                        var $extraX = 10;

                        if (($( window ).width() / 2) <  e.pageX)
                            $extraX = -164;

                        $("#tooltip").css({
                            'top': e.pageY + 10 + 'px',
                            'left': e.pageX + $extraX +'px'
                        });

                        $("#tooltip").stop(true, true).delay(100).toggle();

                        e.stopPropagation();
                    });
                }

            }
        };
    });