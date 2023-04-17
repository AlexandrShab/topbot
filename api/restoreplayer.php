<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/classplayer.php';
require_once __DIR__ . '/request.php';  

$player = new Player;

if($_POST['id'])
{
    //print_r($_POST);
    $player->id = $_POST['id'];
    $player->getInfo();
    $player->team = $_POST['team'];
    $player->restore_player = 'true';
    sendDataToBot($player);
        
} 

$inputJSON = file_get_contents('php://input');
if ($inputJSON)
{
    $input = json_decode( $inputJSON, TRUE );
    if($input['id'])
    {
        $player->id = $input['id'];
        $player->team = $input['team'];
    }
}
        /* Object for restore player 
            { 
                "id": 995,
                "team": 3   
            }
        */
if ($player->id)
{
    $date = new DateTime('');
    $player->date_in = $date->format('Y-m-d');
    $res = $player->restore();
    if ($res ==true){
        header("Location: /getPlayer?id=$player->id");
        
    }
}