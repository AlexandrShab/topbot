<?php
header('Access-Control-Allow-Origin: *');

include_once __DIR__ . '/class_user.php';
require_once __DIR__ . '/mysql.php';

$dataBase = new BaseAPI;
$data = $dataBase->getAllUsers();
$output = '<h1>Авторизованные пользователи</h1>';
for($i = 0;$i<count($data);$i++)
{
   $user = new User($data[$i]);
   $output .="<div class=\"user-box\" style=\"margin:40px;
    padding:20px;
    background-color:beige;
    border: 2px solid gray;\">"; 
   $output .= $i+1 . '. ' . $user->getUserBox().'</div>';
}
header('Content-Type: text/html');
print_r($output);