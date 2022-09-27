<?php
require_once __DIR__ . '/autoload.php';
/*echo '_ENV <br/>';
var_dump($_ENV);
echo '<br/>';
echo '_SERVER <br/>';
var_dump($_SERVER);
echo '<br/>';*/
echo '_POST<br/>';
//var_dump($_POST);
$db = new BaseAPI;
$BOT_URL = $db->getBotUrl();
var_dump($BOT_URL);
//$BOT_URL = "https://script.google.com/macros/s/AKfycbxdNfVhOc2bDhaQR6QDJ9huTB8WdzEZ5UfqgG0zpwIEOLSKykTCndXaFeRG8ylOn-3L/exec"; // URL-адрес POST 
$sPD = "name=Jacob&bench=150"; // Данные POST
$aHTTP = array(
                'http' => // Обертка, которая будет использоваться
                    array(
                        'method'  => 'POST', // Метод запроса
                        // Ниже задаются заголовки запроса
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $sPD
                    )
                );
$context = stream_context_create($aHTTP);
file_get_contents($BOT_URL, false, $context);
/*$contents = file_get_contents($sURL, false, $context);
echo $contents;*/