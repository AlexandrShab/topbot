<?php
function sendDataToBot($postData)
{
    $db = new BaseAPI;
    $BOT_URL_OBJ = $db->getBotUrl();
    $BOT_URL = $BOT_URL_OBJ->value;
    $aHTTP = array(
                    'http' =>
                        array(
                            'method'  => 'POST', 
                            'header'  => 'Content-type: application/json',
                            'content' => json_encode($postData)
                        )
                    );
    $context = stream_context_create($aHTTP);
    file_get_contents($BOT_URL, false, $context);
    return true;
}   