smartApp.controller('PromoListCtrl', [ '$rootScope', '$scope', 'APIPromo', 'APIPromoCode', 'dialogs', '$modal', 'APIArticles', '$translate', 'alerts',
    function ($rootScope, $scope, APIPromo, APIPromoCode,dialogs, $modal, APIArticles, $translate, alerts) {

        $rootScope.topBoxSelectors = false;

        $scope.$on("$destroy", function() {
            $rootScope.topBoxSelectors = true;
        });

        APIArticles.getByFilters($rootScope.app.id, null, null, null, null, 'free').success(function(data){
            $scope.articles = data;
        });

        $rootScope.$watch('app', function(newValue, oldValue) {
            if (newValue===oldValue)
                return;

            exe();
        });

        $scope.copy = function (promoCode){

            $translate(
                ['promo_code.copy.title', 'promo_code.copy.msg', 'data_not_valid','ok', 'cancel', 'only_numbers']
            ).then(function(translations){
                $.SmartMessageBox({
                    title: translations['promo_code.copy.title'],
                    content: translations['promo_code.copy.msg'],
                    buttons: '['+translations['cancel']+']['+translations['ok']+']',
                    input: "text",
                    inputValue: '1'
                }, function (ButtonPress, value) {
                    if (ButtonPress == translations['ok'])
                    {
                        if (isNaN(value))
                            alerts.addError(translations['only_numbers']);
                        else
                        {
                            if (value > 100)
                                alerts.addError(translations['data_not_valid']);
                            else{
                                APIPromoCode.copy($rootScope.app.id, promoCode.id, value).success(function(data){
                                    var oldData = $scope.promos;
                                    exe(
                                        function(){
                                            angular.forEach(oldData, function(oldPromoCode) {
                                                angular.forEach($scope.promos, function(promoCode) {
                                                    if (oldPromoCode.id == promoCode.id)
                                                        promoCode.collapsed = oldPromoCode.collapsed;
                                                });
                                            });
                                        }
                                    );
                                });
                            }
                        }
                    }
                });

            });
        };

        $scope.collapseAll = function(collapse){
            angular.forEach($scope.promos, function(collection) {
                collection.collapsed = collapse;
            });
        };

        $scope.createOrUpdatePromo = function (promo, isNew)
        {
            isNew = isNew || false;

            var modalInstance = $modal.open({
                controller: "CreateOrUpdatePromoCtl",
                templateUrl: 'create_or_update_promo.html',
                backdrop: 'static',
                resolve: {
                    promo: function(){
                        return promo;
                    },
                    promos: function(){
                        return $scope.promos;
                    },
                    isNew: function(){
                        return isNew;
                    }
                }
            });
        };

        $scope.loadMore = function()
        {
            APIPromo.getByAppId($rootScope.app.id, $scope.currentPage).success(function (data){
                if (data.length > 0)
                {
                    formatAPIPromoResult(data);
                    var temp = $scope.promos;
                    angular.forEach(data, function(promo) {
                        temp.push(promo);
                    });
                    $scope.promos = temp;
                    $scope.currentPage++;
                }

                if (data.length < 20)
                {
                    $scope.maxCurrentPage = true;
                }

            });
        };

        $scope.createOrUpdatePromoCode = function (promoCode, promo, isNew)
        {
            isNew = isNew || false;

            var modalInstance = $modal.open({
                controller: "CreateOrUpdatePromoCodeCtl",
                templateUrl: 'create_or_update_promo_code.html',
                backdrop: 'static',
                resolve: {
                    promoCode: function(){
                        return promoCode;
                    },
                    promo: function(){
                        return promo;
                    },
                    promos: function(){
                        return $scope.promos;
                    },
                    isNew: function(){
                        return isNew;
                    },
                    articles: function(){
                        return $scope.articles;
                    }

                }
            });
        };

        function formatAPIPromoResult(data)
        {
            var gamers;
            angular.forEach(data, function(promo) {
                angular.forEach(promo.promo_codes, function(promoCode) {
                    if (promoCode.article)
                        promoCode.article = promoCode.article.id;

                    gamers = [];
                    angular.forEach(promoCode.gamers, function(gamer) {
                        gamers.push(gamer.gamer_external_id);
                    });
                    promoCode.gamers = gamers;

                });

                promo.collapsed = true;
            });
            return data;
        }

        function exe(callback){

            $scope.currentPage = 1;
            $scope.maxCurrentPage = false;
            callback = callback || function(){};
            APIPromo.getByAppId($rootScope.app.id).success(function (data){

                $scope.promos = formatAPIPromoResult(data);
                callback();

                if (data.length < 20)
                {
                    $scope.maxCurrentPage = true;
                }

            });
        }

        $scope.deletePromoCode = function(promoCode, promo){
            APIPromoCode.delete($rootScope.app.id, promo.id, promoCode.id).success(function (data){
                promo.promo_codes.splice( promo.promo_codes.indexOf(promoCode), 1 );
            });
        };

        $scope.deletePromo = function (promo) {

            APIPromo.delete($rootScope.app.id, promo.id).success(function (data){
                $scope.promos.splice( $scope.promos.indexOf(promo), 1 );
            });

        };

        exe();

}]).controller('CreateOrUpdatePromoCtl', [ '$rootScope', '$scope', 'APIPromo', 'dialogs', '$modalInstance', 'promo', 'promos', 'isNew',
    function ($rootScope, $scope, APIPromo, dialogs, $modalInstance, promo, promos, isNew) {

        var promoCopy = angular.copy(promo);
        if (promoCopy.begin_at)
            promoCopy.begin_at = moment(promoCopy.begin_at).toDate();

        if (promoCopy.end_at)
            promoCopy.end_at = moment(promoCopy.end_at).toDate();

        $scope.promo = promoCopy;

        $scope.ok = function () {

            if (isNew)
            {
                APIPromo.create($rootScope.app.id,$scope.promo).success(function(data){
                    $scope.promo.id = data.id;
                    $scope.promo.created_at = data.created_at;
                    $scope.promo.times_used = 0;
                    $scope.promo.promo_codes = [];
                    $scope.collapsed = false;
                    if (promos) promos.unshift($scope.promo);

                    $modalInstance.close();
                });

            }else{

                APIPromo.update($rootScope.app.id, $scope.promo.id, $scope.promo).success(function(data){
                    promo.name = $scope.promo.name;
                    promo.n_uses_per_user = $scope.promo.n_uses_per_user;
                    promo.n_total_uses = $scope.promo.n_total_uses;
                    promo.begin_at = $scope.promo.begin_at;
                    promo.end_at = $scope.promo.end_at;

                    $modalInstance.close();
                });
            }

        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]).controller('CreateOrUpdatePromoCodeCtl', [ 'Utils', '$rootScope', '$scope', 'APIPromoCode', 'dialogs', '$modalInstance', 'promos', 'promo', 'promoCode', 'isNew', 'articles', 'alerts', '$translate',
    function (Utils, $rootScope, $scope, APIPromoCode, dialogs, $modalInstance, promos, promo, promoCode, isNew, articles, alerts, $translate) {

        $scope.articles = articles;

        var promoCodeCopy = angular.copy(promoCode);
        if (promoCodeCopy.begin_at)
            promoCodeCopy.begin_at = moment(promoCodeCopy.begin_at).toDate();

        if (promoCodeCopy.end_at)
            promoCodeCopy.end_at = moment(promoCodeCopy.end_at).toDate();

        $scope.promoCode = promoCodeCopy;

        function codeIsValid(code, excludePromoCodeId){
            var valid = true;
            angular.forEach(promos, function(promo) {
                angular.forEach(promo.promo_codes, function(promoCode) {
                    if (promoCode.id != excludePromoCodeId && promoCode.code == code)
                        valid = false
                });
            });

            return valid;
        }

        function generateNewPromoId()
        {
            var flag = true, newId;
            while (flag)
            {
                newId = Utils.generateId(8);
                if (codeIsValid(newId))
                    flag=false;
            }

            return newId;
        }

        if (isNew)
        {
            $scope.promoCode.code = generateNewPromoId();
        }

        $scope.ok = function () {

            if (!codeIsValid($scope.promoCode.code, $scope.promoCode.id))
            {
                $translate(
                    ['promo_code.error_code_is_already_taken']
                ).then(function(translations){
                    alerts.addError(translations['error_code_is_already_taken']);
                });

                return;
            }

            if (isNew)
            {
                APIPromoCode.create($rootScope.app.id, promo.id, $scope.promoCode).success(function(data){

                    $scope.promoCode.id = data.id;
                    $scope.promoCode.times_used = 0;
                    promo.promo_codes.push($scope.promoCode);

                    $modalInstance.close();
                });

            }else{

                APIPromoCode.update($rootScope.app.id, promo.id, $scope.promoCode.id, $scope.promoCode).success(function(data){
                    promoCode.code = $scope.promoCode.code;
                    promoCode.n_uses_per_user = $scope.promoCode.n_uses_per_user;
                    promoCode.n_total_uses = $scope.promoCode.n_total_uses;
                    promoCode.begin_at = $scope.promoCode.begin_at;
                    promoCode.end_at = $scope.promoCode.end_at;
                    promoCode.article = $scope.promoCode.article;
                    promoCode.gamers = $scope.promoCode.gamers;

                    $modalInstance.close();
                });
            }

        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]);
