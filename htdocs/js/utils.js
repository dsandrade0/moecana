  var Utils = {
    lastPage: function() {
      history.back();
    },

    ip: function() {
      if (window.XMLHttpRequest) { 
        xmlhttp = new XMLHttpRequest();
      } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.open("GET", "http://api.hostip.info/get_html.php", false);
      xmlhttp.send();

      hostip = xmlhttp.responseText.split("\n");
      var r = hostip[2].split(':')[1].replace(' ','');

      return r;
    },

    back: function() {
      window.history.go(-1);
    }
  }
