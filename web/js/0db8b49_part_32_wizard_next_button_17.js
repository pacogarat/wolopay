smartApp.directive('wizardNextButton', [ 'dialogs', '$translate', function(dialogs, $translate) {
    return {
        restrict: 'E',
        scope: {
            formName: '=formName',
            invalid: '=invalid'
        },
        template: '<div style="float: right;margin-top: -10px;">' +
            '<button type="button" ng-if="$root.configuratorCurrent.step > 0" ng-click="$root.configuratorCurrent.step = $root.configuratorCurrent.step-1; console.log(3123);" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> {[{ "back" | translate }]}</button>' +
            '<button type="submit" ng-disabled="formName[\'$invalid\'] || ( invalid === null || invalid)" class="btn btn-info" style="margin-left: 5px">{[{ "next" | translate }]} <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>' +
            '</div>'

    }
}]);