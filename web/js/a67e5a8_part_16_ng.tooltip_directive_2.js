var timer;
angular.module('shopApp').directive('tooltip',
    ['Device', '$rootScope', '$interval', '$timeout', function(Device, $rootScope, $interval, $timeout) {
        return {
            scope: {
                autoRefresh: '=',
                gacha: '=',
                isArticle: '='
            },
            link : function(scope, element, attrs) {
                var timerGacha ;

                if ($rootScope.device.hasMouse)
                {

                    $(element.parent().parent()).mousemove(function(e){

                        var $extraX = 0;

                        if (($( window ).width() / 2) + 70  <  e.pageX)
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

                        if (timer)
                            $interval.cancel(timer);

                        if (attrs.autoRefresh)
                            timer = $interval(sync, 1000);

                        if (scope.isArticle)
                        {
                            timerGacha = $timeout(function(){
                                $rootScope.$apply(function(){
                                    $rootScope.gacha = scope.gacha;
                                });
                            }, 500);
                        }

                    });

                    element.parent().parent().bind('mouseleave', function() {
                        $("#tooltip").stop(true, true).delay(100).fadeOut();
                        $interval.cancel(timer);
                        if (timerGacha)
                            $timeout.cancel(timerGacha);
                    });

                }else{

                    $('html').click(function() {
                        $("#tooltip").stop(true, true).delay(100).hide();
                    });

                    $(element).parent().siblings('.product-info-button').bind('click', function(e) {
                        e.stopPropagation();
                        $("#tooltip").html($(element).html());
                        var position = $(element).position();

                        var $extraX = 20;

                        if (($( window ).width() / 2) + 20 <  e.pageX)
                            $extraX = -300;

                        $("#tooltip").css({
                            'top': e.pageY - 15 + 'px',
                            'left': e.pageX + $extraX +'px'
                        });

                        $("#tooltip").stop(true, true).delay(100).toggle();
                    });
                }

            }
        };
    }]);