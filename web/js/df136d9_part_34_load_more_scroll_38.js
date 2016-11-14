smartApp.factory('LoadMoreScroll', [ function () {

    return {
        onScroll: function (callback, heightFromBottom) {

            heightFromBottom = heightFromBottom || 200;

            function bindScroll(){
                if($(window).scrollTop() + $(window).height() > $(document).height() - heightFromBottom) {
                    $(window).unbind('scroll');
                    callback();
                }
            }

            $(window).scroll(bindScroll);

            return bindScroll;
        },
        clear: function () {
            $(window).scroll(bindScroll);
        }
    };

}]);