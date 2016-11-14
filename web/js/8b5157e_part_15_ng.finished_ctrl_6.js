angular.module('shopApp').controller('FinishedCtrl', ['HandleTransactionStatus', function (HandleTransactionStatus) {

    HandleTransactionStatus.verify();
    $('.wolo-container .ready').css('visibility', 'visible');

}]);