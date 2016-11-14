smartApp.factory('dialogs', ['$rootScope', '$timeout', '$modal', function ($rootScope, $timeout, $modal) {

    var _b = true; // backdrop
    var _k = true; // keyboard
    var _w = 'dialogs-default'; // windowClass
    var _copy = true; // controls use of angular.copy
    var _wTmpl = null; // window template
    var _wSize = 'lg'; // large modal window default

    var _setOpts = function(opts){
        var _opts = {};
        opts = opts || {};
        _opts.kb = (angular.isDefined(opts.keyboard)) ? opts.keyboard : _k; // values: true,false
        _opts.bd = (angular.isDefined(opts.backdrop)) ? opts.backdrop : _b; // values: 'static',true,false
        _opts.ws = (angular.isDefined(opts.size) && (angular.equals(opts.size,'sm') || angular.equals(opts.size,'lg') || angular.equals(opts.size,'md'))) ? opts.size : _wSize; // values: 'sm', 'lg', 'md'
        _opts.wc = (angular.isDefined(opts.windowClass)) ? opts.windowClass : _w; // additional CSS class(es) to be added to a modal window

        return _opts;
    };

    return {
        confirm : function(header,msg,opts){
            opts = _setOpts(opts);

            return $modal.open({
                templateUrl : '/dialogs/confirm.html',
                controller : 'confirmDialogCtrl',
                backdrop: opts.bd,
                keyboard: opts.kb,
                windowClass: opts.wc,
                size: opts.ws,
                resolve : {
                    data : function(){
                        return {
                            header : angular.copy(header),
                            msg : angular.copy(msg)
                        };
                    }
                }
            }); // end modal.open
        }
    };
}])
    .run(['$templateCache','$interpolate', '$translate', function($templateCache, $interpolate, $translate){

//        $templateCache.put('/dialogs/error.html','<div class="modal-header dialog-header-error"><button type="button" class="close" ng-click="close()">&times;</button><h4 class="modal-title text-danger"><span class="glyphicon glyphicon-warning-sign"></span> <span ng-bind-html="header"></span></h4></div><div class="modal-body text-danger" ng-bind-html="msg"></div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="close()">'+startSym+'"DIALOGS_CLOSE" | translate'+endSym+'</button></div>');
//        $templateCache.put('/dialogs/wait.html','<div class="modal-header dialog-header-wait"><h4 class="modal-title"><span class="glyphicon glyphicon-time"></span> '+startSym+'header'+endSym+'</h4></div><div class="modal-body"><p ng-bind-html="msg"></p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" ng-style="getProgress()"></div><span class="sr-only">'+startSym+'progress'+endSym+''+startSym+'"DIALOGS_PERCENT_COMPLETE" | translate'+endSym+'</span></div></div>');
//        $templateCache.put('/dialogs/notify.html','<div class="modal-header dialog-header-notify"><button type="button" class="close" ng-click="close()" class="pull-right">&times;</button><h4 class="modal-title text-info"><span class="glyphicon glyphicon-info-sign"></span> '+startSym+'header'+endSym+'</h4></div><div class="modal-body text-info" ng-bind-html="msg"></div><div class="modal-footer"><button type="button" class="btn btn-primary" ng-click="close()">'+startSym+'"DIALOGS_OK" | translate'+endSym+'</button></div>');
        $templateCache.put('/dialogs/confirm.html','<div class="modal-header dialog-header-confirm"><button type="button" class="close" ng-click="no()">&times;</button><h4 class="modal-title"><span class="glyphicon glyphicon-check"></span> {[{header | translate }]}</h4></div><div class="modal-body">{[{msg | translate }]}</div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="yes()">{[{ "yes" | translate }]}</button><button type="button" class="btn btn-primary" ng-click="no()">{[{ "no" | translate }]}</button></div>');
    }]) // end run / dialogs.main
    .controller('confirmDialogCtrl',['$scope','$modalInstance','data',function($scope,$modalInstance,data){
    //-- Variables -----//

    $scope.header = (angular.isDefined(data.header)) ? data.header : 'dialog.are_u_sure_title_default';
    $scope.msg = (angular.isDefined(data.msg)) ? data.msg : 'dialog.are_u_sure_desc_default';

    //-- Methods -----//

    $scope.no = function(){
        $modalInstance.dismiss('no');
    }; // end close

    $scope.yes = function(){
        $modalInstance.close('yes');
    }; // end yes
}]);
;