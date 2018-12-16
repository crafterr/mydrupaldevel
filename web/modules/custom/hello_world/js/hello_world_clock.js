(function (Drupal, $) {

  "use strict";
  Drupal.behaviors.helloWorldClock = {
    attach: function (context,settings) {

      function ticker() {
        var date = new Date();
        $(context).find('.clock').html(date.toLocaleTimeString());
      }

      var clock = '<div>The time is <span class="clock"></span></div>';
      $(context).find('.salutation').append(clock);

      $(context).find('.site-branding__text').append(clock);


      setInterval(function(){
        ticker();
      },1000);

    }
  }
  // Our code here.

}) (Drupal, jQuery);