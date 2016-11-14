smartApp.factory('LoadMoreScroll', ['$log', function ($log) {

    return {
        onScroll: function (callback, heightFromBottom) {

            heightFromBottom = heightFromBottom || 200;
            var inExecution = false;

            function bindScroll()
            {
                if($(window).scrollTop() + $(window).height() > $(document).height() - heightFromBottom  && inExecution == false) {
                    inExecution = true;
                    $(window).unbind('scroll');
                    callback(function(){
                        inExecution = false;
                    });
                }
            }

            $(window).scroll(bindScroll);

            return bindScroll;
        },
        onScrollToElement: function (selector, callback, heightExtraFromElement) {

            heightExtraFromElement = heightExtraFromElement || 100;

            function bindScroll(){

                if($(window).scrollTop() + $(window).height() > $(selector).offset().top - heightExtraFromElement) {

                    $(window).unbind('scroll');
                    $log.debug('onScrollToElement executed for element', selector);
                    callback();
                }
            }

            return $(window).scroll(bindScroll);
        },
        clear: function (loadMoreScrollHandler) {
            if (loadMoreScrollHandler)
                $(window).off("scroll", loadMoreScrollHandler);
        }
    };

}]);