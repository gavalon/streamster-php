var myVar = loadScript("http://code.jquery.com/jquery-1.11.0.min.js", defineUrlParam);

function loadScript(url, updateDB) {
    // Adding the script tag to the head as suggested before
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    // Then bind the event to the callback function.
    // There are several events for cross browser compatibility.
    script.onreadystatechange = updateDB;
    script.onload = updateDB;

    // Fire the loading
    head.appendChild(script);
}

function defineUrlParam() {
  $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null){
         return null;
      }
      else{
         return results[1] || 0;
      }
  }
}