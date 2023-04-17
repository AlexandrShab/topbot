<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/mysql.php';
$inputJSON = file_get_contents('php://input');
if ($inputJSON) {
  //print_r($inputJSON);
  $input = json_decode($inputJSON, TRUE);
  //print_r(json_encode($input));
  //var_dump($input);

  /* Object for adding data to base
            { 
                "player_id": 995,
                "date": "24.03.2023",
                "km": 96
            }
        */
  $base = new BaseAPI;
  $res = $base->saveKm($input);
    $result['ok'] = "Что-то пошло не так";
    if ($res = true) $result['ok'] = 'OK - saved';
  header('Content-Type: application/json');
  print_r(json_encode($result));

  
}
