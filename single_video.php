<?php 


require('./php-oauth/src/OAuth2/Client.php');
require('./php-oauth/src/OAuth2/GrantType/IGrantType.php');
require('./php-oauth/src/OAuth2/GrantType/AuthorizationCode.php');

const CLIENT_ID     = 'df0b16a519f13cb01d36ce0b0233d620074f789242f3aec51bebbb0f4f9e1cba';
const RESPONSE_TYPE = 'code';
const CLIENT_SECRET = '3b6e4af36d658a2347381db8c554ff8d38ad8595112c2eb2b9f249850fbabaec';

const REDIRECT_URI           = 'http://streamsterphp.azurewebsites.net/single_video.php';
//const REDIRECT_URI           = 'http://localhost/streamster-php/single_video.php';
const AUTHORIZATION_ENDPOINT = 'https://www.coinbase.com/oauth/authorize';
const TOKEN_ENDPOINT         = 'https://www.coinbase.com/oauth/token';


$client = new OAuth2\Client(CLIENT_ID, CLIENT_SECRET, RESPONSE_TYPE);

if (!isset($_GET['code']))
{
   $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
   header('Location: ' . $auth_url);
   die('Redirect');
}

$code = $_GET['code'];

$ch = curl_init();

$string = 'grant_type=' . 'authorization_code' . '&code=' .$code . '&client_id=df0b16a519f13cb01d36ce0b0233d620074f789242f3aec51bebbb0f4f9e1cba&client_secret=3b6e4af36d658a2347381db8c554ff8d38ad8595112c2eb2b9f249850fbabaec&redirect_uri=http://localhost/streamster/single_video';

curl_setopt($ch, CURLOPT_URL,"https://api.coinbase.com/oauth/token");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close ($ch);






/*

include('./vendor/autoload.php');
use \Coinbase\Wallet\Client;
use \Coinbase\Wallet\Configuration;
$configuration = Configuration::oauth($accessToken);

$client = Client::create($configuration);
//$swag = $client->getCurrentUser(); */

?>

<title>
      Streamster - Jello Fight
</title>

<head>
   <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="./bootstrap/css/custom.css">

   <!-- player skin -->
   <link rel="stylesheet" href="./bootstrap/css/fp/functional.css">

   <!-- site specific styling -->
   <style>
   body { font: 12px "Myriad Pro", "Lucida Grande", sans-serif; text-align: center; padding-top: 5%; }
   .flowplayer { width: 80%; margin-top: 13vh;}
   </style>

   <!-- for video tag based installs flowplayer depends on jQuery 1.7.2+ -->
   <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

   <!-- include flowplayer -->
   <script src="./js/flowplayer.min.js"></script>
   <script src="./js/flowtimer.js"></script>
   <!-- Firebase -->
   <script src="https://cdn.firebase.com/js/client/2.2.1/firebase.js"></script>




</head>

<body>
   <!-- navbar -->
   <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="home_button" href="./home">
               HOME
            </a>
         </div>
         <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
               <li><a href="./browse.html">BROWSE</a></li>
               <li><a href="./about.html">ABOUT</a></li>
            </ul>
         </div>
      </div>
   </nav>
   <!-- End of navbar -->

   <!-- the player -->

<div class="flowplayer" data-analytics="UA-73749016-1" title="Jelly Fight" data-swf="./js/flowplayer.swf" data-ratio="0.4167">
      <video>
         <source type="video/mp4" src="http://streamster.huyenchip.com/videos/jellofight.mp4">
      </video>
   </div>

   <!-- <p>To watch this video in full, you would need: </p> -->
   <div id="time-spent"></div>
   <div id="current-time-spent"></div>
   <div id="views-info"></div>
   <!-- <p>bitcoin</p> -->
   <p><?php echo gettype($response) ?></p>
   <p><?php echo $response ?></p>
</body>