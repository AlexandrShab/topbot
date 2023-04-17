<?php
//var_dump($_FILES);

//$fName= 'Scrin.jpg';
$temp_dir =  __DIR__ . '/public/temp/';
$players_bw_dir = __DIR__ . '/public/bw/';
$players_img_dir = __DIR__ . '/public/players_img/';
$uploaddir = __DIR__ . '/public/uploads/';

if(isset($_FILES['screenshot']))
{
    $fName = basename($_FILES['screenshot']['name']);
  $uploadfile = $uploaddir . $fName; 
    if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadfile)) 
        {
            // echo "Файл корректен и был успешно загружен.\n";
        } 
    else {
            echo "Загрузка изображения не удалась!\n";
            echo 'Некоторая отладочная информация:';
            echo '<pre>';
            print_r($_FILES);
            print "</pre>";
            echo "<br/>";
        }   



$img = new Imagick($uploadfile);

//Приводим избражение к ширине 1280px
$img->resizeImage(1280,0, Imagick::FILTER_UNDEFINED,1);//1280*591
file_put_contents($uploadfile, $img);//Замена файла приведенным к размерам изображением
$imgTemp = $img->clone();
$link = "/public/uploads/". $fName;
echo "<img src=\"$link\" width=\"100%\"><br/><br/>";
    
    $imgTemp->blackThresholdImage( "#777777" );//a5a5a5
    $imgTemp->whiteThresholdImage( "#777777" );

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
    $line =  $imgTemp->clone(); // Создаем обЪект текущей строки пикселей
    
   $line->cropImage(250,1,374,$row); //записываем в обЪект строку
   
   $distortion = $line->getImageDistortion($wLine, Imagick::METRIC_MEANSQUAREERROR)*100;//находим величину искажения
   //echo "row - ". $row . " - distortion = " . $distortion . "<br/>";
   if($distortion < 60) $widthOfWhite ++;//Если в строке много светлого делаем +1 к светлым строкам
   if($widthOfWhite == 3)//Если подряд идет три не черных строки
   {
       $arrUpHeights[] = $row - 2; //записываем в массив номер строки с верхом строки игрока
       //echo "начало строки игрока = " . ($row - 2);echo "<br/>";
   }
   if($widthOfWhite > 30 && $distortion > 59) //Если высота поля строк не черного цвета и появляется черная полоса
   {
       $heightOfRow[] = $widthOfWhite; //считаем, что это был конец поля игрока и записываем высоту поля игрока в массив
       //echo "Высота строки игрока = $widthOfWhite<br/>";
       $widthOfWhite = 0;// обнуляем подсчет белых строк
   }
   $line->clear();// очищаем обЪект строки пикселей
}





$players = scandir($players_bw_dir);
array_shift($players);  //    Удаляем '.' 
array_shift($players);  //    и '..'

$hArr = $arrUpHeights; //[170,217,263,309,355,401,447];
for($n=0;$n<count($heightOfRow);$n++)
{
    $find = 0;
    $imgTmp = new Imagick($uploadfile); 
    $imgTmp->cropImage(250,$heightOfRow[$n],374,$hArr[$n]);
    $imgTmp->blackThresholdImage( "#777777" );//a5a5a5
    $imgTmp->whiteThresholdImage( "#777777" );
    $imgTmp->shaveImage(0, 3);//Обрезаем картинку верх и низ по 3px
    $imgTmp->borderImage(new ImagickPixel('white'), 0, 3);//Возвращаем обрезанное белого цвета
    $num = $n+1;
    echo "Строка $num: <br/>";
    $min_res = 100;
    $tmp_file = 'tmp';
    $player = 'Не найден.jpg';
    
    for($i=0;$i<count($players);$i++)
    {
        $sample = new \Imagick($players_bw_dir . $players[$i]);
        $sample->thumbnailImage(250,$heightOfRow[$n]);
     /*
        $samp_size = $sample->getImageGeometry();// return arr - ['width']=>1280,["height"]=>597
        //  Подгоняем размер
        if($samp_size['height'] > $heightOfRow[$n]) $sample->shaveImage(0, 1);
        if($samp_size['height'] < $heightOfRow[$n]) $sample->borderImage(new ImagickPixel('white'), 0, 3);
        
     */   
        $result = $imgTmp->getImageDistortion($sample, Imagick::METRIC_MEANSQUAREERROR)*100;
        //echo "- $players[$i] ? - Distortion = $result"; echo "<br/>";
        
        
        if($result < $min_res)
        {
            $min_res = $result;
            
            
            
            $player = $players[$i];
            //$player = substr($players[$i], 0,-4);
        }
        
        /*if($result < 1){
                $find = 1;
                echo $players[$i];
                continue;
                }*/
                
               
        $sample->clear();
        
    }
    if ($min_res >10){echo 'Не найден';}else {
    $ext = '.jpg';
    file_put_contents($temp_dir . $tmp_file.$n.$ext, $imgTmp);
   
    echo "<img src='/public/temp/$tmp_file$n$ext' width=500px> <img src='/public/bw/$player' width=500px><br/> <br/> ";
    echo "/public/temp/$tmp_file$n$ext<br/>";
    echo $player;    
    }
    echo " - $min_res";
    echo "<br/><br/>"; 
    //if($find>0){echo 'Нашел!!!';}
    $imgTmp->clear();
    
}

}else print_r('Вы не отправили файл!');

