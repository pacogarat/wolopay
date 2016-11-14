angular.module('shopApp').controller('TutorialCtrl', function ($scope, $rootScope, $timeout, $log, findObject) {

    $scope.text = '';

    function addArrowEffect()
    {
        $("#arrow-box img").addClass("effect");
        $("#arrow-box").show();
    }

    function removeArrowEffect()
    {
        $("#arrow-box img").removeClass("effect");
    }

    var lastPosition;

    function load(id, extraLeft, extraTop, text, fnToContinue, cb)
    {
        $log.debug(fnToContinue);
        var el = $(id);
        var p = el.offset();
        if (!p)
        {
            $log.debug(id+" not found waiting");
            $timeout(function (){load(id, extraLeft, extraTop, text, fnToContinue, cb);}, 1000);
        }else{
            lastPosition = { el: el, extraLeft: extraLeft, extraTop: extraTop};
            if (isNaN(fnToContinue()) && fnToContinue())
            {
                cb();
                return;
            }
            moveArrow(el, p, extraLeft, extraTop);
            addArrowEffect();
            $scope.text = text;
            // pending if (fnToContinue)
            executeInfiniteUntilTrue(fnToContinue, cb);
        }
    }

    function moveArrow(el, p, extraLeft, extraTop)
    {
        $("#arrow-box").animate({left: p.left + (el.width()/2) - 20 + extraLeft, top: p.top + el.height() + extraTop });
    }

    function executeInfiniteUntilTrue(fnToContinue, cb)
    {
        var result = fnToContinue();
        $log.debug(result);
        if (result == false || !result)
            return $timeout(function (){executeInfiniteUntilTrue(fnToContinue, cb);}, 300);
        else
        {
            if (isNaN(result)==false)
                return $timeout(function (){cb()}, result*1000);
            else
                return $timeout(function (){cb()}, 200); // delay animation
        }
    }

    function tutorialStandard()
    {
        $log.debug("executing tutorial standard");
        load("#cat-single_payment", ($( window ).width()<700 ? 35: 0), -5, 'tutorial.standard.bar_tab', function(){ return 10 }, function(){
            load(".product:first", 0, 0, 'tutorial.standard.select_article', function(){ return ($rootScope.current.appShopHasArticle) }, function(){
                load(".pay-box_inner:first", 0, 0, 'tutorial.standard.select_paymethod', function(){ return $rootScope.current.articlePMPCA }, function(){
                    load(".pay-button", 0, 0, 'tutorial.standard.buy', function(){ return 5 }, function(){
                        load("#footer ul li:nth-child(2n)", 0, 10, 'tutorial.standard.support', function(){ return 9 }, function(){
                            $rootScope.current.tutorialEnabled = false;
                            if (typeof ga !== 'undefined')
                                ga('send', 'pageview', { page: location.protocol + '//' + location.host + '/shop/tutorial/ended' });
                        });
                    });
                });
            });
        });
    }

    function tutorialPromoCode()
    {
        $log.debug("executing tutorial promo code");
        load("#cat-free", 0, 0, 'tutorial.promo.bar_free_tab', function(){ return $rootScope.current.articleTab.id == 'free' ? 1 : false }, function(){
            load(".product:first", 0, 0, 'tutorial.standard.select_article', function(){ return $rootScope.current.appShopHasArticle ? 1 : false }, function(){
                load(".pay-box_inner:first", 0, 0, 'tutorial.standard.select_paymethod', function(){ return $rootScope.current.articlePMPCA }, function(){
                    load("#promo-code-input", 0, 15, 'tutorial.promo.insert_code', function(){ return $rootScope.current.code }, function(){
//                        load("#promo-code .close", ($( window ).width()<700 ? -85: 0), 10, 'tutorial.promo.close_window', function(){ return $rootScope.current.state == 'ready_to_buy' }, function(){
                            load(".pay-button", 0, 0, 'tutorial.standard.buy', function(){ return 9 }, function(){
                                $rootScope.current.tutorialEnabled = false;
                                if (typeof ga !== 'undefined')
                                    ga('send', 'pageview', { page: location.protocol + '//' + location.host + '/shop/tutorial/ended' });
                            });
//                        });
                    });
                });
            });
        });
    }

    function detectPromoTypeAndExecute()
    {
        if (!$rootScope.current.articleTabs)
        {
            $timeout(function (){detectPromoTypeAndExecute();}, 1000);
            return;
        }

        if (typeof ga !== 'undefined')
        {
            ga('send', 'event', 'Tutorial Started', 'start');
        }

        $("#arrow-box").show();

        if (findObject.byId($rootScope.current.articleTabs, 'free') != -1 && $rootScope.current.tutorialPromoCode)
            tutorialPromoCode();
        else
            tutorialStandard();
    }

    angular.element(document).ready(function() {
        detectPromoTypeAndExecute();
    });

    $(window).resize(function() {
        if (lastPosition)
        {
            moveArrow(lastPosition.el, lastPosition.el.offset(), lastPosition.extraLeft, lastPosition.extraTop);
        }
    });

});