<?php
header('Access-Control-Allow-Origin: *');
    require_once __DIR__ . '/mysql.php';
    
   
    $inputJSON = file_get_contents('php://input');
    if ($inputJSON){
        //print_r($inputJSON);
        $input = json_decode( $inputJSON, TRUE ); 
        //print_r(json_encode($input));
        //print_r($input);
        $players = $input['players'];
        /* {
                "players": players,
        }*/
        $res = 0;
        $base = new BaseAPI;
        foreach($players as $player)
        {
            $base->updatePlayerName($player);
            $res ++;
        }
       
     
        header('Content-Type: application/json');
        print_r("Обновлено ников: $res");
        
    }