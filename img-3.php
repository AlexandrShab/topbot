<?php
$players_img_dir = __DIR__ . '/public/players_img/';
$players_bw_dir = __DIR__ . '/public/bw/';
$uploaddir = __DIR__ . '/public/uploads/';
$img = new Imagick(__DIR__  . '/public/uploads/Screen.jpg');//shot

   $imgTemp = $img->clone();

 //blackThresholdImage()//Перевести все пиксели ниже порогового значения в чёрный цвет
    $img->blackThresholdImage( "#c1c1c1" );
    $img->whiteThresholdImage( "#c0c0c0" );
    
//~~~~~~~~~~~~ Поиск строк с игроками нашей команды ~~~~~~~~~~~~
$wLine = new Imagick(); //Белая линия
    $wLine->newImage(250, 1, new ImagickPixel('white'));//строка пикселей белого цвета
    $wLine->setImageFormat('jpeg'); 
    $row=0;
    $widthOfWhite = 0;//Ширина не черной полосы
    $arrUpHeights = []; //Массив h-координат строк игроков
    $heightOfRows = []; // Массив высот строк игроков
for($i=0;$i<350;$i++)
{   
    $row = $i+160;// Начинаем поиск со 160-й строки
    $line =  $img->clone(); // Создаем обЪект текущей строки пикселей
    
   $line->cropImage(250,1,374,$row); //записываем в обЪект строку
   
   $distortion = $line->getImageDistortion($wLine, Imagick::METRIC_MEANSQUAREERROR)*100;//находим величину искажения
   //echo "row - ". $row . " - distortion = " . $distortion . "<br/>";
   if($distortion < 60) $widthOfWhite ++;//Если в строке много светлого делаем +1 к светлым строкам
   if($widthOfWhite == 3)//Если подряд идет три не черных строки
   {    // Координата h строки игрока
       $arrUpHeights[] = $row - 2; //записываем в массив номер строки с верхом строки игрока
       //echo "начало строки игрока = " . ($row - 2);echo "<br/>";
   }
   if($widthOfWhite > 30 && $distortion > 59) //Если высота поля строк не черного цвета и появляется черная полоса
   {    // Высота строки игрока
       $heightOfRow[] = $widthOfWhite; //считаем, что это был конец поля игрока и записываем высоту поля игрока в массив
       //echo "Высота строки игрока = $widthOfWhite<br/>";
       $widthOfWhite = 0;// обнуляем подсчет белых строк
   }
   
   
   $line->clear();// очищаем обЪект строки пикселей
   
}

//~~~~~~~~~~~~Конец Поиска строк с игроками нашей команды ~~~~~~~~~~~~
  
   $players = scandir($players_img_dir);//$players_bw_dir
    array_shift($players);  //    Удаляем '.' 
    array_shift($players);  //    и '..' 
    
 /*   
foreach($players as $player)
{   
    $pl_img = new Imagick($players_img_dir . $player);
    
    $pl_img->blackThresholdImage( "#777777" );
    $pl_img->whiteThresholdImage( "#777777" );
    /*
    $pl_img->shaveImage(0, 3);//Обрезаем картинку верх и низ по 3px
    $pl_img->borderImage(new ImagickPixel('white'), 0, 3);//Возвращаем обрезанное белого цвета
    
    file_put_contents($players_bw_dir . $player, $pl_img);
  
    $pl_img->clear();
    $line->clear();
    echo "<img src='/public/players_img/$player' width=500px> <img src='/public/bw/$player' width=500px><br/> <br/> ";
    // echo "<img src='/public/players_img/$player' width=200px><br/> <br/> ";
     
    
} */

   


    $imgTemp->cropImage(250,$heightOfRow[1],374,$arrUpHeights[1]);//$heightOfRow[5]
     $imgTemp->blackThresholdImage( "#777777" );
    $imgTemp->whiteThresholdImage( "#777777" );
    
    
    //file_put_contents(__DIR__ . '/public/players_img/' . 'Кирилл.jpg', $imgTemp);
//$imgTemp->cropImage(250,39,374,209);
    $num = $n+1;
    echo "Строка $num: ";
    $min_res = 100;
    $player = 'Не найден';
    for($i=0;$i<count($players);$i++)
    {
        $sample = new \Imagick($players_bw_dir . $players[$i]);
        //$sample->thumbnailImage(250,$heightOfRow[$n]);
        $samp_size = $sample->getImageGeometry();// return arr - ['width']=>1280,["height"]=>597
        //  Подгоняем размер
        if($samp_size['height'] > $heightOfRow[$n]) $sample->shaveImage(0, 1);
        if($samp_size['height'] < $heightOfRow[$n]) $sample->borderImage(new ImagickPixel('white'), 0, 3);
        
        
        $result = $imgTemp->getImageDistortion($sample, Imagick::METRIC_MEANSQUAREERROR)*100;
        echo "- $players[$i] ? - Distortion = $result"; echo "<br/>";
       
        if($result < $min_res)
        {
            $min_res = $result;
            $player = substr($players[$i], 0,-4);
        }
        
        /*if($result < 1){
                $find = 1;
                echo $players[$i];
                continue;
                }*/
                
               
        $sample->clear();
    }
    if ($min_res >10){echo 'Не найден';}else {echo $player;}
    echo " - $min_res";
    echo "<br/><br/>"; 
    //if($find>0){echo 'Нашел!!!';}
    $imgTmp->clear();
//}
/*
header('Content-type: image/jpeg');
echo $imgTemp;
  /* 
