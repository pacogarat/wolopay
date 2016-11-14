angular.module('shopApp').factory('pageTransition', ['$rootScope', function ($rootScope) {

    // added prefix .wolo-container to avoid collision with bootstrap for external resources

    showIframe();

    function OpenInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }

    function checkIframeLoaded(callback) {
        // Get a handle to the iframe element
        $('.wolo-container #iframe').load(function() {
            callback();
        });
    }

    function hideIframe()
    {
        $('.wolo-container #iframe').css('visibility','hidden');
        $('.wolo-container #iframe-overlay').css('display','block');
        $('.wolo-container #iframe-overlay').css('z-index',0);
        $('.wolo-container #iframe').css('z-index',-1);
    }

    function showIframe()
    {
        $('.wolo-container #iframe-overlay').css('z-index',1);

        $('.wolo-container #iframe').css('visibility','visible');

        $('.wolo-container #iframe').css('z-index',0);

        $('.wolo-container #iframe-overlay').fadeOut("slow", function() {
            $('.wolo-container #iframe-overlay').css('z-index',-1).css('display','none');
        });
    }


    return {
        iframeOpen: function (url){

            if ($rootScope.current.iframe)
            {
                hideIframe();
                $('.wolo-container #iframe').attr('src', url);
                checkIframeLoaded(function(){showIframe()});

                $('.wolo-container .ready').css('min-height', 900); // avoid collision with bootstrap for external resources

                return;
            }

            if ( window.innerWidth < 750 || screen.width < 750)
            {
                OpenInNewTab(url);

            }else{

                hideIframe();
                $('.wolo-container #iframe').attr('src', url);
                checkIframeLoaded(function(){showIframe()});
                $('.wolo-container #iframe-box').fadeIn();
                $('.wolo-container #iframe-box-content').addClass('open');
//                $('.wolo-container #iframe-box-content').animate({height: 612}, 700);
                $rootScope.current.iframe = true;
                $('.wolo-container .ready').css('min-height', 900); // avoid collision with bootstrap for external resources

            }

        },
        iframeClose: function (){

            $rootScope.current.iframe = null;

            $('.wolo-container #iframe-box-content').removeClass('open');
//            $('.wolo-container #iframe-box-content').animate({height: 0}, 1000);
            $('.wolo-container #iframe-box').delay( 700 ).fadeOut();


            // avoid collision with bootstrap for external resources
            setTimeout(function() {
                $('.wolo-container .ready').css('min-height', '');
            }, 400);

        },
        newPageOpen: function (url){

            OpenInNewTab(url);
        }

    };
}]);
