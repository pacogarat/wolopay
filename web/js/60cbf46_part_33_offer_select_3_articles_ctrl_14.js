smartApp.controller('OfferSelectArticlesController', ['$scope', '$rootScope', 'APIArticles', 'Utils', 'localize', 'APIAppShopHasArticles',
    function ($scope, $rootScope, APIArticles, Utils, localize, APIAppShopHasArticles) {

    APIArticles.getByAppIdAndShopsAndCountries($rootScope.app.id, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops),
            Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.countries), localize.currentLang.langCode)
                .success(function(data){

                    $rootScope.offerCurrent.articles = Utils.reselectPreviousSession1Level(data, $rootScope.offerCurrent.articles);


    });

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.articles, function(value) {
            if (value.selected)
                result = true;
        });

        return result;
    };

    $scope.tableInfo = function (article) {

        APIAppShopHasArticles.getByArticleId(article.id).success(function (data){
            var th = [], td = [], x = 0, y=0;

            td[0] = [];
            td[0][0] = [];

            function searchIfExistById(array, search)
            {
                var result = false;

                angular.forEach(array, function(value, key) {

                    if (value == search)
                        result = key;
                });

                return result;
            }

            function searchIfExistCountry(array, search)
            {
                var result = false;
                angular.forEach(array, function(value, key) {
                    if (value[0] == search)
                        result = key;
                });

                return result;
            }

            angular.forEach(appShopHasArticles, function(appShopHasArticle) {


                var column = searchIfExistById(td[0], appShopHasArticle.app_shop.name);

                if (!column)
                {
                    column = ++x;

                    td[0][column] = [];
                    td[0][column].push(appShopHasArticle.app_shop.name);
                }

                row = searchIfExistCountry(td, appShopHasArticle.country.name);
                if (!row)
                {
                    row = ++y;

                    if (!td[row])
                        td[row] = [];

                    if (!td[row][0])
                        td[row][0] = [];

                    td[row][0].push(appShopHasArticle.country.name);
                }

                if (!td[row][column])
                    td[row][column] = [];

                var text;
                if (typeof appShopHasArticle.current_amount_without_offer === "undefined")
                    text = '-';
                else
                    text = appShopHasArticle.current_amount_without_offer  + appShopHasArticle.country.currency.symbol;

                td[row][column].push(text);

            });

            var result = "<table style=''>", value;
            for(i=0; i<30; i++)
            {
                result+="<tr>";
                for(j=0; j<30; j++)
                {
                    value = (td[i] ? td[i][j]|| (td[0][j] ? '-' : '') : '' );
                    result+="<td style='"+(j==0 && td[i] ? 'border-right:1px dashed #ccc;' : '' )+(i==0 && td[0][j] ? 'border-bottom:1px dashed #ccc;' : '' ) +(td[i] && td[0][j] ? 'text-align:center;padding:3px 10px;': '')+"'>"+value+"</td>";
                }
                result+="</tr>";
            }
            result+="</table>";

            return result;
        });


    }

}]);
