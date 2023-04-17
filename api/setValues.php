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
            "boturl": webAppUrlInBase,
            "teamnames": nameComand.join()
        }
    */
  $base = new BaseAPI;
   $wurl = $input['boturl'];
   $names = $input['teamnames'];
  // echo $wurl . '<br/>'.$names;
  $res = $base->saveVars($wurl, $names);
  //$res = $base->saveVars($wurl,$names);
  //if ($res == true) {

    header('Content-Type: application/json');
   print_r($res);
 // }
}