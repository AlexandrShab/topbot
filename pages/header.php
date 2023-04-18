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
        .spinner {
          width: 40px;
          height: 98px;
          display: inline-block;
          position: relative;
          border: 2px solid #FFF;
          box-sizing: border-box;
          color: rgba(255, 61, 0, 0.9);
          border-radius: 20px 20px 4px 4px;
          background: #fff;
          animation: fill 2s ease infinite alternate;
        }
        .spinner::after {
          content: '';
          box-sizing: border-box;
          position: absolute;
          left: 50%;
          top: 0%;
          transform: translate(-50% , -95%);
          border: 2px solid #FFF;
          border-bottom: none;
          background: #fff;
          width: 15px;
          height: 35px;
          animation: fillNeck 2s ease infinite alternate;
        }

        @keyframes fill {
          0% { box-shadow: 0 0  inset }
          50% , 100% { box-shadow: 0 -98px inset }
        }


        @keyframes fillNeck {
          0% , 50%{ box-shadow: 0 0  inset }
          100% { box-shadow: 0 -20px inset }
        }

 

/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
        .loading {
            visibility: hidden;
            display: flex;
            position: fixed;
            top: 0px;
            left: 0px;
            background-color: rgba(20, 20, 20, 0.7);
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            z-index: 20;
            transition: 0.2s;
        }

/*        .spinner {

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
       */
    </style>
</head>

<body>
    <div id="loader" class="loading" onclick="hideloading()">
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
            window.addEventListener("unload", hideloading)
            hideloading()
        }
        
        function loading(){
            let loader = document.getElementById('loader')
            loader.style.visibility = 'visible'
        }
        function hideloading(){
            let loader = document.getElementById('loader')
            loader.style.visibility = 'hidden'
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