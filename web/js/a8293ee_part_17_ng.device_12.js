// Routing is external provided by FosJsBundle

angular.module('shopApp').factory('Device', function () {

    return {
        isBigScreen: function () {
          return $( window ).width() > 960;
        },
        hasMouse: function(){
          return 'ontouchstart' in window ? false : true;
        }
    };
});