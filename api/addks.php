<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/mysql.php';
 
$inputJSON = file_get_contents('php://input');
if ($inputJSON) {
  //print_r($inputJSON);
  $input = json_decode($inputJSON, TRUE);
    //print_r(json_encode($input));
    //print_r($input);
    /*
        {
          "name": "NewKCName"
        }
    */
  $base = new BaseAPI;
  $res= false;
  if($input['name'])
      {
          $res = $base->addKc($input['name']);
      }
  if($input['newName'])
        {
            $res = $base->renameKS($input['newName']);
        }
    header('Content-Type: application/json');
    print_r(json_encode($res));
  
  
}
