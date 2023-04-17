<?php
header('Access-Control-Allow-Origin: *');
    require_once __DIR__ . '/mysql.php';

    $base = new BaseAPI;
    $lastId = $base->getLastPlayerId();
    header('Content-Type: application/json');
    
    $lastId = $lastId['MAX(id)'];
print_r($lastId+1);