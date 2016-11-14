smartApp.controller('ConfiguratorSelectSMSController', ['APIAppShopHasArticles', 'APIAppShops', 'APICountries', 'APIArticles', 'APIPayMethods', '$scope', 'Utils', '$rootScope', '$http', 'Watchers',
    function (APIAppShopHasArticles, APIAppShops, APICountries, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http, Watchers) {

        Watchers.formIsDirty('form_sms', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

        $scope.single = { article_category: { id: 'single_payment'} };
        $scope.empty = false;
        $scope.loading = true;
        $scope.articles = [];

        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.appShops = data;
        });

        $scope.payMethodCustomsAvailableByCountry = null;

        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.tab = data[0].level_category;
            $scope.categories = data;
        });

        var wasLoadedLoadArticlesByCountry = [];

        function loadArticlesByCountry(countryId, callback)
        {
            callback = callback || function(){};

            if (wasLoadedLoadArticlesByCountry.indexOf(countryId) != -1)
            {
                console.log("NOT LOADED");
                callback();
                return;
            }

            wasLoadedLoadArticlesByCountry.push(countryId);

            APIArticles.getArticleByAppId($rootScope.app.id, 1, null, null, countryId).success(function (data){

                angular.forEach(data, function(article){
                    angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){
                        angular.forEach(appShopHasArticle._s_m_ss, function(sms){
                            appShopHasArticle['selected_sms_'+sms.id]=true;
                        });
                        angular.forEach(appShopHasArticle.voices, function(voice){
                            appShopHasArticle['selected_voice_'+ voice.id]=true;
                        });
                    });
                });

                $scope.articles = $scope.articles.concat(data);
                callback();
            });
        }


        APIPayMethods.getSpecialsByAppId($rootScope.app.id).success(function (data){
            $scope.payMethodCustoms = data;

            APICountries.getAllByAppIdAvailable($rootScope.app.id).success(function (countries){
                var toDelete = [];

                // delete countries with empty custom paymethods
                angular.forEach(countries, function(country){
                    if ($scope.payMethodSpecialByCurrentCountry(country.id) === null)
                        toDelete.push(country);
                });

                angular.forEach(toDelete, function(country){
                    countries.splice( countries.indexOf(country), 1 );
                });

                // end delete
                if ($scope.payMethodCustoms.length == 0 || countries.length == 0)
                {
                    $rootScope.configuratorCurrent.step = 9;
                    $scope.empty = true;
                    return;
                }

                APICountries.getByAppId($rootScope.app.id).success(function (countriesConfigured){
                    $scope.hasSomeOther = false;
                    var flagFirstCountryConfigured = false;

                    angular.forEach(countries, function(country){

                        var countryCloser = searchConfiguredCountry(countriesConfigured, country);

                        if (countryCloser.id != country.id)
                        {
                            $scope.hasSomeOther = true;
                            country.realCountryConfigured = countryCloser;

                        }else if (!flagFirstCountryConfigured){

                            $scope.countrySelected = country;
                            flagFirstCountryConfigured = true;
                        }

                    });

                    $scope.countries = countries;

                    $scope.onChangeCountry($scope.countrySelected, $scope.countrySelected);
                    $scope.loading = false;
                });


            });


        });

        var OTHER               = 'XA', // Generic 4 all
            OTHER_EUROPE        = 'XB',
            OTHER_SOUTH_AMERICA = 'XC',
            OTHER_AUSTRALIA     = 'XD',
            OTHER_NORTH_AMERICA = 'XE',
            OTHER_ASIA          = 'XF',
            OTHER_AFRICA        = 'XG',

            continentRelated = {}
            ;

        continentRelated['europe'] = OTHER_EUROPE;
        continentRelated['south_america'] = OTHER_SOUTH_AMERICA;
        continentRelated['australia'] = OTHER_AUSTRALIA;
        continentRelated['north_america'] = OTHER_NORTH_AMERICA;
        continentRelated['asia'] = OTHER_ASIA;
        continentRelated['africa'] = OTHER_AFRICA;

        function searchConfiguredCountry(countriesConfigured, country)
        {
            var result, others = {};
            angular.forEach(countriesConfigured, function(countryConfigured){

                if (country.id == countryConfigured.id)
                    result = countryConfigured;

                if (countryConfigured.id.substring(0, 1) == 'X')
                    others[countryConfigured.id] = countryConfigured;
            });

            if (!result)
            {
                if (others[continentRelated[country.continent.id]])
                    result = others[continentRelated[country.continent.id]];

                if (!result)
                {
                    if (others[OTHER])
                        result = others[OTHER];
                }
            }

            return result;
        }

        $scope.onChangeCountry = function (country, countryConfigured)
        {
            loadArticlesByCountry(
                countryConfigured.id,
                function(){
                    $scope.countrySelected = country;
                    $scope.payMethodCustomsAvailableByCountry = $scope.payMethodSpecialByCurrentCountry(country.id);
                    $scope.customsAvailableByCountryGrouped = groupPayMethodSpecial($scope.payMethodCustomsAvailableByCountry);
            });

        };

        $scope.payMethodSpecialByCurrentCountry = function (countryId)
        {
            var result = [];
            angular.forEach($scope.payMethodCustoms, function(pm){
                angular.forEach(pm.pay_method_has_provider, function(pmp){
                    angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc){

                        if (pmp.is_our_implementation && pmpc.country.id === countryId && (pmpc._s_m_ss.length > 0 || pmpc.voices.length > 0)){
                            pmpc.img = pm.img;
                            result.push(pmpc);
                        }
                    });
                });
            });

            return (result.length == 0 ? null : result);
        };

        function groupPayMethodSpecial(pmpcs)
        {
            function findIfSMSHaveSameAmountAndSameFee(smsE)
            {
                var val;
                angular.forEach(result, function(sms){
                    if (sms.type=='sms' && sms.amount == smsE.amount && sms.fee_provider_percent == smsE.fee_provider_percent)
                        val = sms;
                });

                return val;
            }

            function findIfVoiceHaveSameAmountAndSameFee(voiceE)
            {
                var val;
                angular.forEach(result, function(voice){
                    if (voice.type=='voice' && voice.amount == voiceE.amount && voice.fee_provider_percent == voiceE.fee_provider_percent)
                        val = voice;
                });

                return val;
            }

            var result = [], same;
            angular.forEach(pmpcs, function(pmpc){

                if (pmpc._s_m_ss)
                {
                    angular.forEach(pmpc._s_m_ss, function(sms){

                        sms.fee_provider_percent = pmpc.fee_provider_percent;
                        sms.currency = pmpc.currency;
                        sms.type = 'sms';
                        sms.img = pmpc.img;

                        same = findIfSMSHaveSameAmountAndSameFee(sms);

                        if (same)
                        {
                            same.operator.name += ', '+ sms.operator.name;
                            if (typeof same.group == 'undefined')
                                same.group = [];

                            same.group.push(sms);
                        }else{
                            result.push(sms);
                        }

                    });
                }

                if (pmpc.voices)
                {
                    angular.forEach(pmpc.voices, function(voice) {

                        voice.fee_provider_percent = pmpc.fee_provider_percent;
                        voice.currency = pmpc.currency;
                        voice.type = 'voice';
                        voice.img = pmpc.img;

                        same = findIfVoiceHaveSameAmountAndSameFee(voice);

                        if (same)
                        {
                            //same.operator.name += ', '+ sms.operator.name;
                            if (typeof same.group == 'undefined')
                                same.group = [];

                            same.group.push(voice);
                        }else{
                            result.push(voice);
                        }

                    });
                }
            });

            return result;
        }

        $scope.checkboxSelectedPayMethod = function (appShopArticle, smsOrVoice, active, prefix){

            if (smsOrVoice.group)
            {
                angular.forEach(smsOrVoice.group, function(obj){
                    appShopArticle[prefix + obj.id] = active;
                });
            }

        };

        $scope.submit = function (){
            $http.put('/admin/api/article/sync/special_pay_methods/app/'+$rootScope.app.id, {articles: $scope.articles}).success(function(data){
                $rootScope.configuratorCurrent.step = $rootScope.configuratorCurrent.step + 1;
            });
        };

}]);
