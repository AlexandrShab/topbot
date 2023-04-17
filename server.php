<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/autoload.php';
$inputJSON = file_get_contents('php://input');
if ($inputJSON)
{
    $base = new BaseAPI;
    $input = json_decode($inputJSON, TRUE); 
    if ($input['ks_name']) 
    {
        $table_name = $base->getKsTableName($input['ks_name']);
        $base->saveKcResults($table_name, $input['res_num'], $input['data']);
        header('Content-Type: application/json');
        print_r('{"OK":"saved"}');
    }
    if ($input['setUserAsAdmin'])
    {
        $user_id = $input['setUserAsAdmin'];
        $res = $base->setAsAdmin($user_id);
        if ($res == true)
        {
            header('Content-Type: application/json');
            print_r('{"OK":"Admin Rights were SET"}');
        }
    }
    if ($input['unsetUserAsAdmin'])
    {
        $user_id = $input['unsetUserAsAdmin'];
        $res = $base->unsetAsAdmin($user_id);
        if ($res == true)
        {
            header('Content-Type: application/json');
            print_r('{"OK":"Admin Rights were UNSET"}');
        }
    }
    
}


    