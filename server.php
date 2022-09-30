<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/autoload.php';
$inputJSON = file_get_contents('php://input');
if ($inputJSON){
    //print_r($inputJSON);
    $input = json_decode( $inputJSON, TRUE ); 
    header('Content-Type: application/json');
    print_r(json_encode($input));
    //print_r($input);
}
$tg_user = [
    'id'=>"968407066"
];

$user = new User($tg_user);
$user = $user->init();
var_dump($user);