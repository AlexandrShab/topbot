<?php
header('Access-Control-Allow-Origin: *');
    require_once __DIR__ . '/mysql.php';
 
    $base = new BaseAPI;
    $url = $base->getBotUrl();
    $url = json_encode($url->value);
    header('Content-Type: application/json');
    
    

print_r($url);