<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/classplayer.php';
require_once __DIR__ . '/request.php';  
    $inputJSON = file_get_contents('php://input');
    if ($inputJSON){
        //print_r($inputJSON);
        $input = json_decode( $inputJSON, TRUE ); 
        //print_r(json_encode($input));
        //print_r($input);

       /* Object for adding player to base
            { 
                "id": 995,
                "name": "New Player 7",
                "team": 3
            }
        */

    $player = new Player;
    $player->id = $input['id'];
    $player->name = $input['name'];
    $player->team = $input['team'];

        $date = new DateTime('');
    $player->date_in = $date->format('Y-m-d');

    $res = $player->addToBase();
    if ($res ==true){
        if (isset($input['add_player'])){
        $player->add_player = '1';
        
        sendDataToBot($player);
        }
        header('Content-Type: application/json');
        print_r(json_encode($player));
    }
   }
