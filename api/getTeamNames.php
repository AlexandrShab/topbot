<?php
header('Access-Control-Allow-Origin: *');
    require_once __DIR__ . '/mysql.php';
 
    $base = new BaseAPI;
    $teamNames = $base->getTeamNames();//array
    $teamNames = json_encode($teamNames);
    header('Content-Type: application/json');
print_r($teamNames);