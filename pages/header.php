<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/style.css" rel="stylesheet">
        <title>Belarus🔝Team</title>
        <!--?php echo "<title>$title</title>" ?> -->
        <style>
          .loading {
            visibility: hidden;
            display: flex;
            position: fixed;
            top: 0px;
            left: 0px;
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
    <div id="loader" class="loading" >
        <div class="spinner"></div>
    </div>
    <script>
        
        if (document.readyState == 'loading') {
            // ещё загружается
            loading()
            //ждём события
            document.addEventListener('DOMContentLoaded', hideloading)
            } else {
            // DOM готов!
            hideloading()
            window.addEventListener("unload", hideloading)
           
            }
      function loading() {

        let loader = document.getElementById('loader');
        loader.style.visibility = 'visible';

        }
        function hideloading() {
        let loader = document.getElementById('loader');
        loader.style.visibility = 'hidden';
      }
  </script>
   
    <div class="auth-bar">
        <ava class="dropdown">
                <a href="https://t.me/ByTopBot">
                    <img src="public/img/botava.jpg" style="height:40px">
                </a>
            <div class="dropdown-content help">
                ☝️ Леди Бот
                <img src="public/img/logo-telega.png" style="height:16px">
            </div>
        </ava>
        <ava class="dropdown">
            <a href="https://t.me/sborRB"><img src="public/img/chatlogo.jpg" style="height:40px"></a>
            <div class="dropdown-content help">
                ☝️ <strong>Belarus🔝Team</strong> - группа
                    <img src="public/img/logo-telega.png" style="height:16px">
                </div>
        </ava>
        <ava class="dropdown">
            <a href="https://t.me/tophcr2"><img src="public/img/chanel.jpg" style="height:40px"></a>
            <div class="dropdown-content help">
                ☝️ <strong>Belarus🔝Chanel</strong> - Наш канал
                    <img src="public/img/logo-telega.png" style="height:16px">
                </div>
        </ava>