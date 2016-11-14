shopApp.directive('tooltip',
    function(Device, $rootScope) {
        return {
            link : function(scope, element, attrs) {

                if (Device.hasMouse())
                {
                    $(element.parent()).mousemove(function(e){
                        $("#tooltip").css({
                            'top': e.pageY + 10 + 'px',
                            'left': e.pageX + 10 +'px'
                        });
                    });

                    element.parent().bind('mouseenter', function() {

                        if ($.trim($(element).html()))
                        {
                            $("#tooltip .tooltip-content").html($(element).html());
                            $("#tooltip").stop(true, true).delay(300).fadeIn();
                        }

                    });

                    element.parent().bind('mouseleave', function() {
                        $("#tooltip").stop(true, true).delay(100).fadeOut();
                    });

                }else{

                    $(element).siblings('.product-info-button').bind('click', function(e) {
                        $("#tooltip .tooltip-content").html($(element).html());
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