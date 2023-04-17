<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/style/style.css">
    <!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
-->
    <?php echo "<title>$title</title>" ?> 

</head>

<body>
<div id="container">
  
  <nav class="navbar">
      <div class="dropdown">
        <button class="dropbtn">Меню Админа
            <i class="fa fa-caret-down"></i>
        </button>  
        <div class="dropdown-content">
          <a class="item" href="#">Добавить игрока</a>
          <a class="item" href="#">Удалить игрока</a>
          <a class="item" href="#">Перевод игрока</a>
  <!--
          <input type="button" class="btn" value="Список игроков в базе" @click="getAllPlayers()"><br/>
          <input type="button" class="btn" value="Список актуальных игроков" @click="getPresent()">
-->
        </div>
        
      </div>
      <a class="lnk" href="/">Players</a>
      <a class="lnk" href="https://t.me/ByTopBot">Леди Бот в Telegram</a>
      <div class="authenticate" style="padding-top:10px; float: right">
<?php/*
define('BOT_USERNAME', 'ByTopBot'); // place username of your bot here
function getTelegramUserData() {
  if (isset($_COOKIE['tg_user'])) {
    $auth_data_json = urldecode($_COOKIE['tg_user']);
    $auth_data = json_decode($auth_data_json, true);
    return $auth_data;
  }
  return false;
}

if ($_GET['logout']) {
  setcookie('tg_user', '');
  header('Location: index.php');
}
$tg_user = getTelegramUserData();
$html = '<span> </span> ';
if ($tg_user !== false) {
  $first_name = htmlspecialchars($tg_user['first_name']);
 // $html = '';
 if (isset($tg_user['photo_url'])) {
    $photo_url = htmlspecialchars($tg_user['photo_url']);
    $html .= "<a href=\"?logout=1\"><img src=\"{$photo_url}\" style=\"width:30px; border-radius:15px\">Log out</a>";
  }
  
   // $html .= " {$first_name}!";
  
  
 // $html .= "  <a href=\"?logout=1\">Log out</a>";
} else {
  $bot_username = BOT_USERNAME;
  $html = <<<HTML
  <span> </span>
<script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="{$bot_username}" data-size="medium" data-auth-url="check_authorization.php"></script>
HTML;
}

    echo $html;  */
?>
       <!-- <script async src="https://telegram.org/js/telegram-widget.js?19" data-telegram-login="bytopbot" data-size="medium" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
        <script type="text/javascript">
          function onTelegramAuth(user) {
            alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
          }
        </script>
        -->
      </div>
      
        <br/>
      
  </nav>
  <a class="ava" href="/img/botava.jpg"><img src="/img/botava.jpg" width="70px"></a>