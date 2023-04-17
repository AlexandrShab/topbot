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
          <a class="item" href="/addPlayerPage.php">Добавить игрока</a>
          <a class="item" href="#">Внести гаражи</a>
          <a class="item" href="#">Внести данные по КМ</a>
          <a class="item" href="#">Внести резы КС</a>
  <!--
          <input type="button" class="btn" value="Список игроков в базе" @click="getAllPlayers()"><br/>
          <input type="button" class="btn" value="Список актуальных игроков" @click="getPresent()">
-->
        </div>
        
      </div>
      <a class="lnk" href="/">Players</a>
      <a class="lnk" href="https://t.me/ByTopBot">Леди-Бот в Telegram</a>
      
      
        <br/>
      
  </nav>
  <a class="ava" href="/img/botava.jpg"><img src="/img/botava.jpg" width="70px"></a>