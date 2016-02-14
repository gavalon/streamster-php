function urlParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

var key = urlParam('key');
var base_url = "https://streamster.firebaseio.com/" + key;
var videoObj = new Firebase(base_url + "/video-url");

videoObj.transaction(function(url) {
    console.log("video set");
    document.getElementById("video").innerHTML = '<source type="video/mp4" src="http://streamster.huyenchip.com/videos/jellofight.mp4">';
    return url;
  });
