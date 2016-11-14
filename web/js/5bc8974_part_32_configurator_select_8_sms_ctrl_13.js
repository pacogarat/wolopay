smartApp.controller('ConfiguratorSelectSMSController', ['APIAppShopHasArticles', 'APIAppShops', 'APICountries', 'APIArticles', 'APIPayMethods', '$scope', 'Utils', '$rootScope', '$http', 'Watchers',
    function (APIAppShopHasArticles, APIAppShops, APICountries, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http, Watchers) {

        Watchers.formIsDirty('form_sms', $scope, function(){ $rootScope.configuratorCurrent.dirty = 1 });

        $scope.single = {article_category: { id: 'single_payment'}};
        $scope.empty = false;
        $scope.loading = true;

        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.appShops = data;
        });

        $scope.payMethodCustomsAvailableByCountry = null;

        APIAppShops.getByAppId($rootScope.app.id).success(function (data){
            $scope.tab = data[0].level_category;
            $scope.categories = data;
        });


        APIPayMethods.getSpecialsByAppId($rootScope.app.id).success(function (data){
            $scope.payMethodCustoms = data;

            APIArticles.getArticleByAppId($rootScope.app.id, 1).success(function (data){
                $scope.articles = data;

                angular.forEach($scope.articles, function(article){
                    angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){
                        angular.forEach(appShopHasArticle.app_shop_article_has_p_m_p_cs, function(asahpmpc){
                            angular.forEach(asahpmpc.sms, function(sms){
                                appShopHasArticle['selected_sms_'+sms.id]=true;
                            });

                            if (asahpmpc.voice != undefined)
                                appShopHasArticle['selected_voice_'+ asahpmpc.voice.id]=true;
                        });
                    });
                });


                APICountries.getByAppId($rootScope.app.id).success(function (countries){
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

                    $scope.countries = countries;
                    $scope.countrySelected = $scope.countries[0];
                    $scope.onChangeCountry($scope.countrySelected);
                    $scope.loading = false;
                });

            });
        });

        $scope.onChangeCountry = function (country)
        {
            $scope.countrySelected = country;
            $scope.payMethodCustomsAvailableByCountry = $scope.payMethodSpecialByCurrentCountry(country.id);
            $scope.customsAvailableByCountryGrouped = groupPayMethodSpecial($scope.payMethodCustomsAvailableByCountry);
        };

        $scope.payMethodSpecialByCurrentCountry = function (countryId)
        {
            var result = [];
            angular.forEach($scope.payMethodCustoms, function(pm){
                angular.forEach(pm.pay_method_has_provider, function(pmp){
                    angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc){
                        if (pmp.is_our_implementation && pmpc.country.id === countryId && (pmpc.sms.length > 0 || pmpc.voice.length > 0)){
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

                if (pmpc.sms)
                {
                    angular.forEach(pmpc.sms, function(sms){

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

                if (pmpc.voice)
                {
                    angular.forEach(pmpc.voice, function(voice){

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
                $rootScope.configuratorCurrent.step = 9;
            });
        };

}]);
