<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/autoload.php';
//var_dump($_COOKIE);
$html = '<span> </span>';
define('BOT_USERNAME', 'ByTopBot'); // place username of your bot here

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

if ($_GET['logout']) {
  setcookie('tg_user', '');
  header('Location: index.php');
}
require_once __DIR__ . '/pages/header.php';

$tg_user = getTelegramUserData();
//~~~~~~~~~Check isAdmin~~~~~~~~~~~~~~~~~~~~~~
if ($tg_user->isAdmin == '1'){$isAdmin = true;}

if ($tg_user !== false) {
  $first_name = htmlspecialchars($tg_user->first_name);
  //$html .= "{$first_name}";
  $html .= "<div style=\"float:right; margin-right:20px;\"><a href=\"/?logout=1\" style=\"text-decoration: none; color:white; 
            margin-right:20px;position: absolute;
            top: 50%;\">Выход</a> ";
   
 if (isset($tg_user->photo_url)) {
    $photo_url = htmlspecialchars($tg_user->photo_url);
    //$photo_url = $tg_user['photo_url'];
    $html .= "<img src=\"{$photo_url}\" style=\"width:30px; 
            border-radius:15px;position: absolute;
            top: 50%;\">";
  } else
      {
          $html .= "<name style=\"position: absolute; float:right;margin-right:20px;\">{$first_name}</name>";
      }
 $html .= "</div>";
}else {
    $bot_username = BOT_USERNAME;
    $authItem = new AuthItem;
    $html = $authItem->content;

}

//~~~~~~~~~~~~~~~~~Разметка страницы~~~~~~~~~~~~~~~~~~~~~~~~~~~

header('Content-Type: text/html');
//require_once __DIR__ . '/pages/header.php';

$html .= "</div>";

$html .= "<ul class=\"bar\">";
  if ($tg_user->isAdmin == '1')
    {
      $menu = new Menu;
      $html .= $menu->content;
    }
$menuItem = new PublicMenuItems;
$html .= $menuItem->content;
  if ($tg_user !== false)
    {
      $players = new PlayersLink;
      $html .= $players->content;
    }
$html .= '</ul>';
print_r($html);
// ~~~~~~~~~~ Начало контента страницы~~~~~~~~~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/news') 
{   
  require_once __DIR__ . '/pages/news.php';
  require_once __DIR__ . '/pages/footer.php';
  exit;
}//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/players') 
{
   // if ($first_name)
   {
      require_once __DIR__ . '/pages/players.php';
      require_once __DIR__ . '/pages/footer.php';
      exit;
    }
}

//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/addPlayer') 
{
   // if ($first_name)
   {
      require_once __DIR__ . '/pages/addPlayer.php';
      require_once __DIR__ . '/pages/footer.php';
      exit;
    }
}
//~~~~~~~~~~~~~
if (($_SERVER["REDIRECT_URL"] == '/getPlayer') && ($_GET['id']))        //getPlayer  
{

  //$colors = ["#DCDCDC", "#C3FBD8", "#C6D8FF", "#FED6BC", "#ffccff", "#CCCC66", "#98FB98", "#f5ff8c"];
  $base = new BaseAPI;

  $player = new Player;

  $player->id = $_GET['id'];
  $player = $player->getInfo();

  $teamNames = $base->getTeamNames();

  $team = $player->team - 1;
  $player->teamName = $teamNames[$team];


  $arrUser = $base->getUserById($player->user_id);
  if ($arrUser == false && $player->user_id > 0){
      $arrUser['id'] = $player->user_id;
      $arrUser['first_name']= $player->fname;
      $arrUser['last_name']= $player->lname;
      $arrUser['username']= $player->username;
  }   
      $user = new User($arrUser);

  $teamNames = $base->getTeamNames();
  $teamName = $teamNames[$player->team-1];

  if(strlen($player->username)<3)
      {
          $player->username = 'Отсутствует';
      }


  if ($player->present == '1')
  {
      $player->present = 'Yes';
  }else
      $player->present = 'No';
  $output .= $player->getPlayerAsHtml(); 
  if (strlen($player->name) < 1)
  {
      $output = "<br/><br/><br/><br/><h1 style='color: darkred;'>Игрока с playerID : <strong>$player->id</strong> не существует!</h1><br/><br/>";
      $output .= "<button class=\"btn-get\" 
          name=\"back\" 
          onclick=\"document.location.href='/players'\">
          Назад</button>";
      echo $output;
      require_once __DIR__ . '/pages/footer.php';
      exit;
  }  
    echo $output;
    
    if($arrUser['id'])
    { 
        $output .= $user->getUserBox();
        echo $output;
    }
    require_once __DIR__ . '/pages/footer.php';
    exit;

} 
//~~~~~~~~~~~~~~~~~~~~~~~ Обработка обращений к API /server~~~~~~~~~~~~~~~
if ($_SERVER["REDIRECT_URL"] == '/server')
{
  if ($_GET)
  {
    if ($_GET['action'] == 'edit_player')
    {
      $player_id = $_GET['player_id'];
      $player = new Player;
      $player->id = $_GET['player_id'];
      $player = $player->getInfo();
      
      require_once __DIR__ . '/pages/edit_player.php';
      require_once __DIR__ . '/pages/footer.php';
      exit;
    }
  }
  if ($_POST)
  {
  
  }
  require_once __DIR__ . '/pages/footer.php';
  exit;
}
//~~~~~~~~~~~~~~~~~~~~~~~
require_once __DIR__ . '/pages/team.php';
echo '<br/>';
echo '_SERVER <br/>';
var_dump($_SERVER);
require_once __DIR__ . '/pages/footer.php';
exit;


