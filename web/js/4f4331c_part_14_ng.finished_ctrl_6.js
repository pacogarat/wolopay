angular.module('shopApp').controller('FinishedCtrl', function (HandleTransactionStatus, alerts) {

    HandleTransactionStatus.verify();

});