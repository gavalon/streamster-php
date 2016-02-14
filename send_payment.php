<?php
$accessToken = 'e8f0775f8f681d05f09a211a54502ceee5d24cda493116d54c307bce0d878be4';
$account_id = 'ea3df725-5698-55d6-b6c1-d697f5eabc9b';
$tucker_addr = '17fhrxKpaHHV4r54TbncDPiyB9GEYGkX8f';
$grant_addr = '1Moyz5FYXLy3LFmER9ya5pruv9VHhpdx64';
// $tucker_addr = 'tucker.leavitt@gmail.com';
// $tucker_addr = 'you suck';

// $cur_user = $client->getCurrentUser();
// $usr_str = serialize($cur_user);
// preg_match('/\"id\".+?:\"((\w|\-)+?)\";/', $usr_str, $match);
// $user_id = $match[1];

$ch = curl_init();

//$price = number_format(0.008 * 5/60 * 1/400, 7);
$price = '0.0000546';

$url = 'https://api.coinbase.com/v2/accounts/'.$account_id.'/transactions';
$fields = array(
   'to' => $tucker_addr,
   'amount' => $price,
   'currency' => 'BTC',
   'type' => 'send',
   // 'fee' => '0.0001',
   'fee' => '0.00009',
   'skip_notifications' => true,
);

// $transaction = Client::send($fields);

$data_string = json_encode($fields);
$curlConfig = array(
   CURLOPT_URL            => $url,
   CURLOPT_POST           => true,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_POSTFIELDS     => $data_string,
   CURLOPT_HTTPHEADER     => array(                                                                          
     'Content-Type: application/json',
     'Authorization: Bearer '. $accessToken,
     'CB-VERSION: 2016-02-13',
   ),
); 
curl_setopt_array($ch, $curlConfig);
$response = curl_exec($ch);
$err_no = curl_errno($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

var_dump($response);
?>