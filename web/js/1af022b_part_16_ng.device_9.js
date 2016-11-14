// Routing is external provided by FosJsBundle

shopApp.factory('Device', function () {

    return {
        isBigScreen: function () {
          return $( window ).width() <= 768;
        },
        hasMouse: function(){
          return 'ontouchstart' in window ? false : true;
        }
    };
});