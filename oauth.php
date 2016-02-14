<?php 
require('./php-oauth/src/OAuth2/Client.php');
require('./php-oauth/src/OAuth2/GrantType/IGrantType.php');
require('./php-oauth/src/OAuth2/GrantType/AuthorizationCode.php');

const CLIENT_ID     = 'df0b16a519f13cb01d36ce0b0233d620074f789242f3aec51bebbb0f4f9e1cba';
const RESPONSE_TYPE = 'code';
const CLIENT_SECRET = '3b6e4af36d658a2347381db8c554ff8d38ad8595112c2eb2b9f249850fbabaec';

//const REDIRECT_URI           = 'http://streamsterphp.azurewebsites.net/single_video.php';
// const REDIRECT_URI           = 'http://localhost/streamster-php/single_video.php';
const REDIRECT_URI           = 'http://streamsterphp.azurewebsites.net/browse.html';
const REDIRECT_URI           = 'http://localhost/streamster-php/browse.html';
const AUTHORIZATION_ENDPOINT = 'https://www.coinbase.com/oauth/authorize';
const TOKEN_ENDPOINT         = 'https://www.coinbase.com/oauth/token';


$client = new \OAuth2\Client(CLIENT_ID, CLIENT_SECRET, RESPONSE_TYPE);

if (!isset($_GET['code']))
{
   $auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT, REDIRECT_URI);
   header('Location: ' . $auth_url);
   die('Redirect');
}

$code = $_GET['code'];
?>