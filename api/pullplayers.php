<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/mysql.php';
require_once __DIR__ . '/classplayer.php';
$sURL = "https://script.google.com/macros/s/AKfycbxjVnWkBfDMqdGZEQsDonYWQFqku0Mgy929k2GhmGnDo8v63Q6v1c1-OY9e_MtoUXEYGg/exec"; // URL-адрес POST 
$base = new BaseAPI;

header('Content-Type: application/json');


$data = array(   // Данные POST
  'get'  => 'players',
  'team'  => '2'
);
$data = json_encode($data);

$aHTTP = array(
  'http' => // Обертка, которая будет использоваться
  array(
    'method'  => 'POST', // Метод запроса
    // Ниже задаются заголовки запроса
    'header'  => 'Content-type: application/json',
    'content' => $data
  )
);
$context = stream_context_create($aHTTP);

$contents = file_get_contents($sURL, true, $context);




$arr = json_decode($contents);
print_r($arr[0]);
/*
for ($i = 0; $i < count($arr); $i++) {
  $player = new Player;
  $player = $player->setProperties($arr[$i]);

  $base->addPlayer($player);
}
*/
echo 'OK';
