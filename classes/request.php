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
function getTelegramUserData() {
    if (isset($_COOKIE['tg_user'])) {
      //include __DIR__ . '/api/class_user.php';
      $auth_data_json = urldecode($_COOKIE['tg_user']);
      $auth_data = json_decode($auth_data_json, true);
      $user = new User($auth_data);
      if(!$user->isInBase())
      {
          $user->addTobase();
      }
      $user->checkAdmin();
  
      return $user;
    }
    return false;
  }