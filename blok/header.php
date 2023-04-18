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
<style>
          .loading {
            visibility: hidden;
            display: flex;
            position: absolute;
            background-color: rgba(255,255,255,0.7);
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            z-index: 20;
            transition: 0.2s;
        }
        .spinner {

            height: 100px;
            width: 100px;
            border-left: 10px solid lightgreen;
            border-bottom: 10px solid lightgreen;
            border-right: 10px solid lightgreen;
            border-top: 10px solid transparent;
            border-radius: 50%;
            animation: spinner 2s ease infinite;
        }

@keyframes spinner {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
</style>
</head>

<body>
  <script>
    function loading() {

      let loader = document.getElementById('loader');
      loader.style.visibility = 'visible';

      }
      function hideloading() {
      let loader = document.getElementById('loader');
      loader.style.visibility = 'hidden';
      }
  </script>
<div id="loader" class="loading" >
        <div class="spinner"></div>
    </div>

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

      </div>
      
        <br/>
      
  </nav>
  <a class="ava" href="/img/botava.jpg"><img src="/img/botava.jpg" width="70px"></a>