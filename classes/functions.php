<?php
function getTelegramUserData() {
  if (isset($_COOKIE['tg_user'])) {
    
    $auth_data_json = urldecode($_COOKIE['tg_user']);
    //print_r($auth_data_json);
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
