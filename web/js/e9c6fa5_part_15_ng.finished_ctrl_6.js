angular.module('shopApp').controller('FinishedCtrl', ['HandleTransactionStatus', function (HandleTransactionStatus) {

    HandleTransactionStatus.verify();

}]);