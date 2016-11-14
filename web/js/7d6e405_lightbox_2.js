if (woPlugin == undefined){

    var wolopayPlugin = function (){

        var baseUrl='//wolopay.com';
        var objectWasInserted = false;
        var container = document.createElement('div');
        var state = null;
        var that = this;

        this.callbackOnClose = null;

        var layerCustomize = "min-height: 100%; margin-bottom:50px; background:#fff;width:100%;border: 2px solid #000;-webkit-box-shadow: 6px 6px 9px 0 rgba(50,50,50,0.75);-moz-box-shadow: 6px 6px 9px 0 rgba(50,50,50,0.75);box-shadow: 6px 6px 9px 0 rgba(50,50,50,0.75);-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;";

        var boxIframe = "<iframe style='height: 1140px;"+layerCustomize+"' scrolling='no' id='wolo-iframe' ></body></html></iframe>";
        var boxDiv = "<div class='wolo-shop' style='"+layerCustomize+"' ></div>";

        container.id = 'wolo-container';
        container.style.cssText="display:none;box-sizing: border-box;z-index: 999999999;position: absolute;width:100%;min-height:"+window.innerHeight+"px;top:0px;left:0px;background: rgba(0,0,0,0.5);opacity:0;-webkit-transition: opacity .25s ease-in-out;-moz-transition: opacity .25s ease-in-out;-ms-transition: opacity .25s ease-in-out;-o-transition: opacity .25s ease-in-out;transition: opacity .25s ease-in-out;opacity:0";
        container.innerHTML="<div id='wolo-iframe-container'><div style='float:right'><img src='"+baseUrl+"/plugin/img/close.png' onclick='woPlugin.close()' style='cursor:pointer;margin: -20px 0 0 -20px;position:absolute'></div><div id='wolo-replacer' style='min-height: 100%'></div><div id='wolo-waiting' style='width: 300px;padding-bottom: 100px; position: fixed; top: 50%; left: 50%; margin-top: -65px; min-height: 50px; margin-left: -150px; text-align: center;-webkit-transition: opacity .5s ease-in-out;-moz-transition: opacity .5s ease-in-out;-ms-transition: opacity .5s ease-in-out;-o-transition: opacity .5s ease-in-out;transition: opacity .5s ease-in-out;opacity:0;'><img src='"+baseUrl+"/img/logo_200x50.png' style='clear:both'></div>";


        this.open = function (url, width, height, callbackOnClose, loadByJs){

            that.callbackOnClose = callbackOnClose || function(){};
            loadByJs = loadByJs || false;

            if (!objectWasInserted)
            {
                document.body.appendChild(container);
                objectWasInserted=true;
            }

            if (loadByJs == false && window.innerWidth < 700 || screen.width < 700)
            {
                var winRef = window.open(url);
                if (winRef)
                    return ;
                else
                    console.warn('WOLO: Error on open a new tab, because window was blocked by browser. To open correctly use relative paths');
            }

            var woloReplacer = document.getElementById('wolo-replacer');
            woloReplacer.innerHTML = loadByJs ? boxDiv : boxIframe;

            var iframe;

            if (loadByJs)
                iframe = document.createElement('script');
            else
                iframe = document.getElementById('wolo-iframe');

            document.getElementById('wolo-container').style.paddingTop = document.body.scrollTop + 'px';
            document.getElementById('wolo-container').style.minHeight = Math.max( document.body.scrollHeight, document.body.offsetHeight) + 'px';

            iframe.addEventListener("load", function(){

                if (state != 'toClose')
                {
                    state = 'toClose';
                    showOverlay(false);
                }

            });

            state = 'toOpen';

            iframe.src=url;

            if (loadByJs)
                woloReplacer.appendChild(iframe);

            container.style.display='block';
            if (container.style.opacity !== undefined)
                container.style.opacity = 1;

            showOverlay(true);

            width  = width || '90.3%';
            height = height || '90.3%';

            var iframeContainer = document.getElementById('wolo-iframe-container');

            iframeContainer.style.width  = width;
            iframeContainer.style.height = height;

            iframeContainer.style.marginTop=getMargin(height, false);
            iframeContainer.style.marginLeft=getMargin(width, true);

        };

        this.close = function (){
            var iframe;

            if (iframe = document.getElementById('wolo-iframe'))
                iframe.src = '';

            if (window.innerWidth > 700)
                closeWindow();
            else
                state = 'toClose';

            that.callbackOnClose();
        };

        function closeWindow(){
            if (container.style.opacity !== undefined)
                container.style.opacity=0;

            setTimeout(function(){
                container.style.display='none';
            }, 1000);
        }

        function showOverlay(show)
        {
            var elm = document.getElementById('wolo-waiting');

            if (show)
            {
                elm.style.opacity = 1;
                elm.style.display = '';

                var woloShop = document.getElementsByClassName('wolo-shop');

                if ( woloShop.length > 0)
                    woloShop[0].style.minHeight = window.innerHeight * 0.87;

            }else{

                elm.style.opacity = 0;
                setTimeout(function(){ elm.style.display = 'none'; }, 250);
            }
        }

        function getMargin(value, isWidth){
            var valueFloat = parseFloat(value);

            if (value.indexOf("%")!=-1){
                if (isWidth)
                    return ((100 - valueFloat) /2) +'%';
                else
                    return ((100 - valueFloat) /5) +'%';
            }else{
                if (isWidth){
                    return (screen.width - valueFloat) /2 +'px';
                }else{
                    return (screen.height - valueFloat) /3+'px';
                }
            }
        }
    };

    var woPlugin = new wolopayPlugin();
}