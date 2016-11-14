describe('unique filter', function() {
    beforeEach(function () {
        module('smartApp');
    });

    it('has a bool filter', inject(function($filter) {

        var data = [
            {'pepe': {'trofo' : 0 }},
            {'pepe': {'trofo' : 1 }},
            {'pepe': {'trofo' : 0 }}
        ];

        var resultExpected = [
            {'pepe': {'trofo' : 0 }},
            {'pepe': {'trofo' : 1 }}
        ];

        var result = $filter('unique')(data, 'pepe.trofo');
        expect(result).toBe(resultExpected);
    }));
});