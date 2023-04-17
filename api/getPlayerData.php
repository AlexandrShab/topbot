<?php
header('Access-Control-Allow-Origin: *');
    require_once __DIR__ . '/mysql.php';
    require_once __DIR__ . '/classplayer.php';
    
   
    $inputJSON = file_get_contents('php://input');
    if ($inputJSON){
        //print_r($inputJSON);
        $input = json_decode( $inputJSON, TRUE ); 
        //print_r(json_encode($input));
        //print_r($input);
        
        $base = new BaseAPI;

        $arrPlayer = $base->getPlayer($input['id']);//учетные данные игрока из базы в виде массива
        
        $player = new Player;
        $player->init($arrPlayer);
        //Написать функцию для сбора данных по резам гаражам и км 
        $player->getAllResults();
        $obj = json_encode($player);
        
        header('Content-Type: application/json');
        print_r( $obj);
        
    }
    
   