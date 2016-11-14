shopApp.factory('pageTransition', function ($rootScope) {
    showIframe();
    function OpenInNewTab(url) {
        var win = window.open(url, '_blank');
        win.focus();
    }

    function checkIframeLoaded(callback) {
        // Get a handle to the iframe element
        $('#iframe').load(function() {
            callback();
        });
    }

    function hideIframe()
    {
        $('#iframe').css('visibility','hidden');
        $('#iframe-overlay').css('display','block');
        $('#iframe-overlay').css('z-index',0);
        $('#iframe').css('z-index',-1);
    }

    function showIframe()
    {
        $('#iframe-overlay').css('z-index',1);

        $('#iframe').css('visibility','visible');

        $('#iframe').css('z-index',0);

        $('#iframe-overlay').fadeOut("slow", function() {
            $('#iframe-overlay').css('z-index',-1).css('display','none');
        });
    }


    return {
        iframeOpen: function (url){

            if ($rootScope.current.iframe)
            {
                hideIframe();
                $('#iframe').attr('src', url);
                checkIframeLoaded(function(){showIframe()});
                return;
            }

            if ( $( window ).width() >= 750)
            {
                hideIframe();
                $('#iframe').attr('src', url);
                checkIframeLoaded(function(){showIframe()});
                $('#iframe-box').fadeIn();
                $('#iframe-box-content').animate({height: 612}, 700);
                $rootScope.current.iframe = true;

            }else{
                OpenInNewTab(url);
            }

        },
        iframeClose: function (){

            $rootScope.current.iframe = null;

            $('#iframe-box-content').animate({height: 0}, 1000);
            $('#iframe-box').delay( 700 ).fadeOut();
        },
        newPageOpen: function (url){

            OpenInNewTab(url);
        }

    };
});
