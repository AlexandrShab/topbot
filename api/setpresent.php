<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/classplayer.php';

    $inputJSON = file_get_contents('php://input');
    if ($inputJSON){
        //print_r($inputJSON);
        $input = json_decode( $inputJSON, TRUE ); 
        //print_r(json_encode($input));
        //print_r($input);

       /* Object for setting present
            { 
                "id": 995,
            }
        */
        $player = new Player;
        $player->id = $input['id'];
        
        
        $res = $player->setPresent($player->id);
        if ($res == true){

            header('Content-Type: application/json');
            print_r(json_encode($player));
        }
   }