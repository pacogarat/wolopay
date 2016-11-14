angular.module('shopApp').controller('GachaCtrl', ['$scope', '$rootScope', '$log', '$timeout', 'APINotification', function ($scope, $rootScope, $log, $timeout, APINotification) {

    $scope.close = false;

    function searchLapsAvailable()
    {
        var laps = 0;
        var mapIndex = {}, noti, articleGiven, paymentDetailHasArticle, articlesAvailable;

        for (var i = 0; i < $rootScope.status.payment_process.payment_detail.payment_detail_has_articles.length; i++)
        {
            if ($rootScope.status.payment_process.payment_detail.payment_detail_has_articles[i].articles_gacha.length > 0)
            {
                articlesAvailable = $rootScope.status.payment_process.payment_detail.payment_detail_has_articles[i].articles_gacha;

                for (var ii = 0; ii < $rootScope.status.payment_process.payment_detail.payment_detail_has_articles[i].payment_detail_articles_has_given_articles.length; ii++)
                {
                    articleGiven = $rootScope.status.payment_process.payment_detail.payment_detail_has_articles[i].payment_detail_articles_has_given_articles[ii];
                    paymentDetailHasArticle = $rootScope.status.payment_process.payment_detail.payment_detail_has_articles[i];
                    noti = $rootScope.status.payment_process.payment_detail.payment_detail_has_articles[i].payment_detail_articles_has_given_articles[ii].purchase_notifications[0];

                    $log.debug("Noti", noti, paymentDetailHasArticle);

                    if (noti && noti.min_delay !== null && noti.was_received == false)
                    {
                        var remainingForUserHistory = articleGiven.remaining_for_user_history;
                        articlesAvailable = angular.copy(articlesAvailable);

                        var total = 0;

                        for (var ia = 0; ia < articlesAvailable.length; ia++)
                        {
                            articlesAvailable[ia].remaining_for_user = 0;

                            if (remainingForUserHistory[ articlesAvailable[ia].possible_article.id ] )
                                articlesAvailable[ia].remaining_for_user = remainingForUserHistory[ articlesAvailable[ia].possible_article.id ] ;

                            total += articlesAvailable[ia].remaining_for_user;

                            if (articlesAvailable[ia].possible_article.id == articleGiven.article.id)
                                articleGiven.article.best_article = articlesAvailable[ia].best_article;
                        }

                        mapIndex[laps] = {
                            articlesAvailable: articlesAvailable,
                            paymentDetailHasArticle: paymentDetailHasArticle,
                            purchaseNotification: noti ,
                            givenArticle: articleGiven,
                            total: total
                        };

                        laps++;
                    }

                }
            }
        }

        $log.debug("MAX LAPS ", laps, "Laps mapped", mapIndex);

        $scope.lapsMax = laps;
        $scope.lapsMapped = mapIndex;
    }

    searchLapsAvailable();

    var articleSize = 200;
    $scope.lap = 0;
    $scope.articlesWon = [];



    function shuffleArray(array)
    {
        for (var i = array.length - 1; i > 0; i--)
        {
            var j = Math.floor(Math.random() * (i + 1));
            var temp = array[i];
            array[i] = array[j];
            array[j] = temp;
        }

        return array;
    }

    function getObjectsRandom ()
    {
        var lapMapped = $scope.lapsMapped[$scope.lap];

        $log.debug("LAP: ", $scope.lap, "Obj", lapMapped);

        var articlesAvailable = lapMapped.articlesAvailable;
        var articleWon = lapMapped.givenArticle.article;

        var articles = [],  i, ii, nItems, percent, amountRemainingByUser ;

        for (i = 0; i < articlesAvailable.length; i++)
        {
            amountRemainingByUser = articlesAvailable[i].remaining_for_user ;

            $log.debug("articleId: ", articlesAvailable[i].possible_article.id, "remaining by user", amountRemainingByUser);

            percent = Math.round(amountRemainingByUser * 100 / lapMapped.total);
            nItems =  24 * percent / 100;

            $log.debug("percent", percent, "nItems", nItems);

            for (ii = 0; ii < nItems; ii++)
            {
                articlesAvailable[i].possible_article.best_article = articlesAvailable[i].best_article;
                articles.push(articlesAvailable[i].possible_article);
            }
        }

        $scope.positionArticleWon = articles.length;

        articles = shuffleArray(articles);

        articles.push(articleWon);
        articles.push(articles[0]);articles.push(articles[1]);articles.push(articles[2]);articles.push(articles[3]);articles.push(articles[4]);articles.push(articles[5]);

        $log.debug("Articles gacha", articles);
        $log.debug("Articles WON index", $scope.positionArticleWon, " OF ", articles.length);

        return articles;
    }

    $scope.objects = getObjectsRandom();
    $scope.playActive = false;

    function randomIntFromInterval(min,max)
    {
        return Math.floor(Math.random()*(max-min+1)+min);
    }

    $scope.playGacha = function()
    {
        var noti;

        var random = randomIntFromInterval(0, (articleSize/2) -1);
        if (random % 2 == 0)
            random = random * -1;

        var nItems = (($('.finished-animation .outer').width() /articleSize) / 2)  ;

        soundWheelStart.play();
        $scope.playActive = true;
        $('.finished-animation .outer ul').css('left', (-$scope.positionArticleWon * articleSize) + ((nItems * articleSize) - (articleSize/2) ) + random );
        $timeout(function(){

            APINotification.updateDelayGacha($scope.lapsMapped[$scope.lap].givenArticle.id);

            $scope.articlesWon.unshift($scope.lapsMapped[$scope.lap].givenArticle.article);
            $scope.lap++;
            soundWheelEnd.play();

            if ($scope.lap < $scope.lapsMax)
            {
                $timeout(function(){
                    $('.finished-animation .outer ul').addClass( "backward").css('left', 0);

                    $scope.objects = getObjectsRandom();

                    $timeout(function(){
                        $scope.playActive = false;
                        $('.finished-animation .outer ul').removeClass("backward");
                    }, 1000);

                }, 3000);

            }else{
                $scope.playActive = false;
            }
        }, 8000);
    }

}]);