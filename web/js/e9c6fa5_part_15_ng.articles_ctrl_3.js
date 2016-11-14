angular.module('shopApp').controller('ArticlesListCtrl', [ 'APIAppShopHasArticles', 'APIArticlePMPCA', '$scope', '$rootScope', '$timeout', '$translate', 'state', '$filter', 'alerts', 'APIItemTab', '$log',
    function (APIAppShopHasArticles, APIArticlePMPCA, $scope, $rootScope, $timeout, $translate, state, $filter, alerts, APIItemTab, $log) {

        APIItemTab.getByAppId();

        $scope.activeOrDisableSearch = function()
        {
            $rootScope.searchActive = !$rootScope.searchActive ;
            $timeout(function() {
                $('.wolo-container .search input').focus();
            }, 400);
        };

        function setItemTabsAvailable ()
        {
            var articles = $rootScope.current.appShopHasArticles;

            if ($rootScope.current.itemTabs == null || $rootScope.current.itemTabs.length <= 0)
                return;

            var result = [], unique_id = [];

            angular.forEach($rootScope.current.itemTabs, function(itemTabActual, index) {
                angular.forEach(articles, function(article, index) {
                    angular.forEach(article.article.item_tabs, function(itemTab, index) {

                        if (itemTab.id == itemTabActual.id && unique_id.indexOf(itemTabActual.id) === -1)
                        {
                            result.push(itemTabActual);
                            unique_id.push(itemTabActual.id);
                        }
                    });
                });
            });


            $scope.itemsTabsAvailable = result;
        }

        $rootScope.$on('apiLoadAppShopHasArticles', function () {
            setItemTabsAvailable();
        });


        $scope.selectItemTab = function (itemTab)
        {
            itemTab.selected = !itemTab.selected;
            $rootScope.$broadcast('itemTabActivated');
        };

        $scope.calculateTime = function (timeString)
        {
            var date = moment(timeString);
            return date.unix() * 1000;
        };

        $scope.getLowerNum = function(num1, num2){

            if (!num1 && num2)
                return num2;

            if (num1 && !num2)
                return num1;

            return Math.min(num1, num2);
        };

        $scope.showRemainingUnits = function(article)
        {
            if ((article.n_purchases_total) &&
                (
                    (article.show_when_stock_under_n==0) ||
                        (
                            (article.show_when_stock_under_n > 0) &&
                                (article.remaining_units < article.show_when_stock_under_n)
                        )
                )
            )
                return article.remaining_units;

            return false;
        };

        $scope.showRemainingUnitsOffer = function(offer)
        {
            if (!offer || !offer.offer_programmer || !offer.offer_programmer.limit_purchases)
                return false;

            return offer.offer_programmer.limit_purchases - offer.offer_programmer.times_used;
        };

        $scope.showTimerArticle = function (article)
        {
            if (!article || !article.valid_to)
                return false;

            var date = moment(article.valid_to);
            var today = moment();
            if (date.unix() < (today.unix() + (60*60*24*7)))
                return true;

            return false;
        };

        $scope.getTimeLower = function (timeString1, timeString2)
        {
            if (!timeString1 && timeString2)
                return timeString2;

            if (timeString1 && !timeString2)
                return timeString1;

            var date1 = moment(timeString1);
            var date2 = moment(timeString2);
            if (date1.unix() < date2.unix())
                return timeString1;

            return timeString2;
        };

        $scope.showTimerOffer = function (offer)
        {
            if (!offer || !offer.offer_to)
                return false;

            var date = moment(offer.offer_to);
            var today = moment();
            if (date.unix() < (today.unix() + (60*60*24*7)))
                return true;

            return false;
        };

        $scope.activateArticle = function (appShopHasArticle)
        {
            if ($rootScope.current.appShopHasArticle && appShopHasArticle.article.id == $rootScope.current.appShopHasArticle.article.id)
                return;

            if ($rootScope.hasCart && $rootScope.current.cart.length >= 1)
            {
                alerts.addWarning('warnings.cant_choose_article');
                return;
            }

            if (typeof ga !== 'undefined')
            {
                $translate(appShopHasArticle.name_label.key, {number : (appShopHasArticle.items_number )}).then(function (translation) {
                    ga('send', 'event', 'Article: '+translation+' selected', 'clicked');
                });
            }

            $rootScope.current.appShopHasArticle = appShopHasArticle;

            if ($rootScope.current.appShopHasArticle.article.articles_gacha.length <= 0)
                $rootScope.gacha = null;

            if (!$rootScope.firstPayMethods)
            {
                $rootScope.current.articlePMPCA = null;
                APIArticlePMPCA.getAll();
            }

            state.refresh();
        };

        $scope.addCartVisible = function (appShopHasArticle)
        {
            if (appShopHasArticle.current_amount_without_offer === 0)
                return false;

            if ($rootScope.hasCart === false)
                return false;

            if (appShopHasArticle.article.article_category.id !== 'single_payment')
                return false;

            return true;
        };

        $scope.removeCartVisible = function (appShopHasArticle)
        {
            return appShopHasArticle.hasCart;
        };

        $rootScope.addCart = function (appShopHasArticle, event)
        {
            if ($rootScope.options.shoppingCartMaxItems <= $rootScope.current.cart.length )
            {
                alerts.addWarning('warnings.shopping_cart_max_items');
                return;
            }

            var img = document.createElement("img");
            img.src = $rootScope.asset(appShopHasArticle.img);
            img.className = 'phantom';

            var oldCart = $rootScope.current.cart;

            var positionImg = $('#article-'+appShopHasArticle.article.id+' .product-image img').offset();
            var positionCart = $('.register-cash .cart').offset();

            $(img).css({top: positionImg.top, left: positionImg.left});
            $('.wolo-container').append(img);
            appShopHasArticle.in_cart = true;
            $rootScope.current.cart.push(appShopHasArticle);
            $rootScope.current.appShopHasArticle = null;

            $timeout(function() {
                $(img).css({top: positionCart.top, left: positionCart.left});

                // animation
                $timeout(function() {
                    $(img).remove();
                    $('.register-cash .cart span').addClass('active');

                    $timeout(function() {
                        $('.register-cash .cart span').removeClass('active');
                    }, 500);

                }, 1000);
            }, 100 );

            commonCartAction(event);
        };
        $rootScope.removeCart = function (appShopHasArticle, event)
        {
            var img = document.createElement("img");
            img.src = $rootScope.asset(appShopHasArticle.img);
            img.className = 'phantom';

            var oldCart = $rootScope.current.cart;

            var positionImg;
            if ($('#article-'+appShopHasArticle.article.id+' .product-image img').length)
                positionImg = $('#article-'+appShopHasArticle.article.id+' .product-image img').offset();
            else
                positionImg = $('.products .outer-wrapper').offset();

            var positionCart = $('.register-cash .cart').offset();

            if (appShopHasArticle.in_cart)
            {
                $(img).css({top: positionCart.top, left: positionCart.left});
                $('.wolo-container').append(img);

                if (countMatches($rootScope.current.cart, appShopHasArticle) <= 1)
                    appShopHasArticle.in_cart  = false;

                $rootScope.current.cart.splice($rootScope.current.cart.indexOf(appShopHasArticle), 1);

                $timeout(function() {
                    $(img).css({top: positionImg.top, left: positionImg.left});

                    // animation
                    $timeout(function() {
                        $(img).remove();
                        $('.register-cash .cart span').addClass('active');

                        $timeout(function() {
                            $('.register-cash .cart span').removeClass('active');
                        }, 500);

                    }, 1000);
                }, 100 );

            }

            commonCartAction(event);
        };



        function commonCartAction(event)
        {
            if(event){
                event.stopPropagation();
                event.preventDefault();
            }
        }

        var debouncetimeOut = null, realOld = [];

        $rootScope.$watchCollection('current.cart', function(newValue, oldValue) {

            if (debouncetimeOut)
                $timeout.cancel(debouncetimeOut);

            debouncetimeOut = $timeout(function() {

                newValue = $filter('unique')(newValue);
                oldValue = $filter('unique')(realOld);

                if (newValue.length == 0)
                {
                    $rootScope.current.real_cart_price = null;
                }else{
                    APIAppShopHasArticles.calculatePrice();
                }

                if (!$rootScope.firstPayMethods && newValue.length === 0 && !$rootScope.current.appShopHasArticle)
                {
                    $rootScope.current.articlePMPCAs = null;

                    return ;
                }

                realOld = newValue;

                if (oldValue.length == newValue.length)
                {
                    if ((!$rootScope.current.articlePMPCAs || $rootScope.current.articlePMPCAs.length == 0) && newValue.length > 0)
                    {
                        // force to refresh

                    }else{
                        $log.debug("IGNORE refresh because they are same articles");
                        return;
                    }

                }

                if (!$rootScope.firstPayMethods)
                {
                    $rootScope.oldPMPCASelected = null;
                    $rootScope.current.articlePMPCA = null;
                    APIArticlePMPCA.getAll();
                }

                state.refresh();


            }, 1000);

        });

        function countMatches(arr, obj)
        {
            var count = 0;
            for (var i = 0; i < arr.length; i++) {
                if (arr[i].article.id == obj.article.id)
                    count++;
            }

            return count;
        }
}]);