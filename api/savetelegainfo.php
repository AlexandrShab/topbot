<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/classplayer.php';

$inputJSON = file_get_contents('php://input');
if ($inputJSON) {
  //print_r($inputJSON);
  $input = json_decode($inputJSON, TRUE);
    //print_r(json_encode($input));
    //print_r($input);
    /*
        {
          "playerID": id,
          "link": friendLink
        }
    */
    $player = new Player;
    $player->id = $input['id'];
    $player->user_id = $input['user_id'];
    $player->fname = $input['faname'];
    $player->lname = $input['laname'];
    $player->username = $input['useraname'];
    $res = $player->storeTelegaInfo();

    if ($res == true) {

        header('Content-Type: application/json');
        print_r(json_encode($res));
  }
}
