<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/classplayer.php';
require_once __DIR__ . '/mysql.php';
require_once __DIR__ . '/request.php';    
    $player = new Player;

    if($_POST['id']) $player->id = $_POST['id'];
    
    $inputJSON = file_get_contents('php://input');
    if ($inputJSON)
    {
        $input = json_decode( $inputJSON, TRUE );
        if($input['id']) $player->id = $input['id']; 
    }

        /* Object for deleting player  (moving to team "0")
            { 
                "id": 995,
            }
        */
    if ($player->id)
    {
       
        $player = $player->getInfo();
    
        $date = new DateTime('');
        $player->date_out = $date->format('Y-m-d');
        $res = $player->delete();
        if (($res ==true) && ($_POST['id'])){
            $player->delete_player = true;
            sendDataToBot($player);
            header("Location: /getPlayer?id=$player->id");
        
        
        }
    }