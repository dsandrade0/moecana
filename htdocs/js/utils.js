  var Utils = {
    lastPage: function() {
      history.back();
    },

    ip: function() {
      var $ip;
      var that = this;
      $.getJSON('http://ipinfo.io', function(data) {
        console.log(data); 
      });
    },

    back: function() {
      window.history.go(-1);
    }
  }
