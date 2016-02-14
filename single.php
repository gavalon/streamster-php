<?php 


$oauth2_client_id = 'df0b16a519f13cb01d36ce0b0233d620074f789242f3aec51bebbb0f4f9e1cba';
$oauth2_secret = '3b6e4af36d658a2347381db8c554ff8d38ad8595112c2eb2b9f249850fbabaec';
$oauth2_redirect = 'http://localhost/streamster/single_video';



$oauth2_server_url = 'https://www.coinbase.com/oauth/authorize';

$query_params = array(
           'response_type' => 'code',
           'client_id' => $oauth2_client_id,
           'redirect_uri' => $oauth2_redirect,
           'scope' => 'wallet:transactions:send:bypass-2fa'
         );


$forward_url = $oauth2_server_url . '?' . http_build_query($query_params);


//header('Location: ' . $forward_url);






?>