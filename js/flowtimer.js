function urlParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}

flowplayer.conf = {
   ratio: 5/12,
   // rtmp: "rtmp://s3b78u0kbtx79q.cloudfront.net/cfx/st"
   splash: false,
   analytics: "UA-73749016-1"
};

var totalTime = 0;
var countDown;
var COST_PER_SECOND = 0.01;

var dbRef = new Firebase('https://streamster.firebaseio.com/');

flowplayer(function(api, root) {
  var key = urlParam('key');
  console.log(key);
  var url = "https://streamster.firebaseio.com/" + key + "/views";
  console.log(url);
  // console.log(dbRef[key]["views"]);
  document.getElementById("views-info").innerHTML = "This video has been viewed times";
  var thisView = new Firebase(url);
  thisView.transaction(function(current) {
    return current+1;
  });
  // Display views

  var ref = new Firebase(url);
  ref.on("value", function(snapshot) {
    document.getElementById("views-info").innerHTML = "This video has been viewed " + snapshot.val() + " times";
  }, function (errorObject) {
    console.log("The read failed: " + errorObject.code);
  });

  var endTime = 0;
  var startingTime;
  api.on("load", function() {
    console.info("Your video is loading ...", api.engine.engineName);
  }).on("ready", function() {
    document.getElementById("time-spent").innerHTML = "To watch the whole video you'd need " + api.video.duration * COST_PER_SECOND + " bitcoins";
    document.getElementById("current-time-spent").innerHTML = "You have spent " + totalTime * COST_PER_SECOND + " bitcoins on this video";
    if (api.playing == true)
      startingTime = getStartTime("starting", totalTime);
  }).on("pause", function() {
    endTime = getEndTime("Resumed", startingTime);
  }).on("resume", function() {
    if (api.playing == true)
      startingTime = getStartTime("resumed", totalTime);
  }).on("finished", function() {
    endTime = getEndTime("Finished", startingTime);
  });
 });


function getEndTime(displayStr, startingTime) {
  window.clearInterval(countDown);
  time = new Date().getTime() / 1000;
  console.info(displayStr, time);
  totalTime = totalTime + time - startingTime;
  console.info("Total time played: ", totalTime);
  return time;
}

function getStartTime(displayStr, totalTime) {
  var time = new Date().getTime() / 1000;
  console.info(displayStr, time);
  countDown = window.setInterval(function(){
    console.log("Another second passed");
    totalTime += 1;
    $.ajax({ url: './send_payment.php',
       data: {action: 'test'},
       type: 'post',
       success: function(output) {
                    console.log("sent payment");
                    // document.getElementById("current-time-spent").innerHTML = "You have spent " + totalTime * COST_PER_SECOND + " bitcoins on this video";
                }
    });
  }, 1000);
  return time;
}
