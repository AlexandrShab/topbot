<?php
header('Access-Control-Allow-Origin: *');
require_once __DIR__ . '/classes/request.php';
require_once __DIR__ . '/classes/functions.php';
require_once __DIR__ . '/autoload.php';
//var_dump($_COOKIE);
$html = '<span> </span>';
define('BOT_USERNAME', 'ByTopBot'); // place username of your bot here

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
  
    $html .= "<a href=\"/?logout=1\" 
        class=\"dropdown\" style=\"float:right;\">
        <img src=\"/public/img/door1.jpg\"
            style=\"height:40px;margin-right:10px;\">
        <div class=\"dropdown-content help\" style=\"transform: translate(-25px,10px);\">
            ☝️ Выход
        </div></a>";
 if (isset($tg_user->photo_url)) {
    $photo_url = htmlspecialchars($tg_user->photo_url);
    //$photo_url = $tg_user['photo_url'];
    $html .= "<img src=\"{$photo_url}\" style=\"width:40px; 
            border-radius:20px;float:right;margin-right:10px;\">";
  }else
      {
          $html .= "<name style=\"float:right;margin:10px;
                color:white;\">{$first_name}</name>";
      }
    
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
  if ($isAdmin)
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
if($_SERVER["REQUEST_URI"] == '/upload-results') 
{
    //if ($isAdmin)
    {
      require_once __DIR__ . '/pages/upload-results.php';
    }  
      require_once __DIR__ . '/pages/footer.php';
      exit;
}
//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/news') 
{   
  require_once __DIR__ . '/pages/news.php';
  require_once __DIR__ . '/pages/footer.php';
  exit;
}//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/players') 
{
    if ($isAdmin)
    {
      require_once __DIR__ . '/pages/players.php';
    }  
      require_once __DIR__ . '/pages/footer.php';
      exit;
    
}
//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/addPlayer') 
{
    if ($isAdmin)
   {
      require_once __DIR__ . '/pages/addPlayer.php';
      require_once __DIR__ . '/pages/footer.php';
      exit;
    }
}
//~~~~~~~~~~~~~
if($_SERVER["REQUEST_URI"] == '/getUsers') 
{
    if ($isAdmin)
   {
        $dataBase = new BaseAPI;
        $data = $dataBase->getAllUsers();
        $output = "<h1 class='name-page'>Авторизованные пользователи</h1>";
        for($i = 0;$i<count($data);$i++)
        {
           $user = new User($data[$i]);
          // $user = $user->init();
           $output .= $user->getUserBox();
        }

        print_r($output);
        require_once __DIR__ . '/pages/footer.php';
        exit;
    }
}
//~~~~~~~~~~~~~
if (($_SERVER["REDIRECT_URL"] == '/getPlayerResults') && ($_GET['id']) && $isAdmin)        //getPlayerResults  
{
    $base = new BaseAPI;
    
    $player = new Player;
    
    $player->id = $_GET['id'];
    $player = $player->getInfo();
                //отправка объекта Player боту для сбора и сохранения резов в FireBase
   // $player->get_player_stat = "true";
    //    sendDataToBot($player);
        
    $teamNames = $base->getTeamNames();
    
    $team = $player->team - 1;
    $player->teamName = $teamNames[$team];
    require_once __DIR__ . '/pages/player_results.php';
    $output;
    $output .= "Игрок ". $player->name . " ID: " . $player->id; 
    echo $output;
    require_once __DIR__ . '/pages/footer.php';
    exit;
}
//~~~~~~~~~~~~~~~
if (($_SERVER["REDIRECT_URL"] == '/getPlayer') && ($_GET['id']) && $isAdmin)        //getPlayer  
{

    //$colors = ["#DCDCDC", "#C3FBD8", "#C6D8FF", "#FED6BC", "#ffccff", "#CCCC66", "#98FB98", "#f5ff8c", "#e999ff"];;
    $base = new BaseAPI;
    
    $player = new Player;
    
    $player->id = $_GET['id'];
    $player = $player->getInfo();
    
    $teamNames = $base->getTeamNames();
    
    $team = $player->team - 1;
    $player->teamName = $teamNames[$team];
    
    $output;
    
    
if (strlen($player->user_id)>1){
    $arrUser = $base->getUserById($player->user_id);
    if ($arrUser == false && $player->user_id > 0){
        $arrUser['id'] = $player->user_id;
        $arrUser['first_name']= $player->fname;
        $arrUser['last_name']= $player->lname;
        $arrUser['username']= $player->username;
    } 
    $user = new User($arrUser);
}
    

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
      $output = $user->getUserBox();
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
    if (($_GET['action'] == 'edit_player') && $isAdmin)
    {
      $player_id = $_GET['player_id'];
      $player = new Player;
      $player->id = $_GET['player_id'];
      $player = $player->getInfo();
      //var_dump($player);
      require_once __DIR__ . '/pages/edit_player.php';
      require_once __DIR__ . '/pages/footer.php';
      exit;
    }
  }
  if ($_POST)
  {
    //var_dump($_POST);
    if(($_POST['update_player']) && $isAdmin)
    {
        $player = new Player;
        $player->init($_POST);
        $player->update();
        sendDataToBot($player);
        header("Location: /getPlayer?id=$player->id");
        exit;
    }
  }
    require_once __DIR__ . '/pages/footer.php';
    exit;
}
//~~~~~~~~~~~~~
require_once __DIR__ . '/pages/team.php';
require_once __DIR__ . '/pages/footer.php';
exit;


