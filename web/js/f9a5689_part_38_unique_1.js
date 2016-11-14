describe('unique filter', function() {
    beforeEach(function () {
        module('smartApp');
    });

    it('has a bool filter', inject(function($filter) {
        console.log("WTF", $filter);
    }));
});