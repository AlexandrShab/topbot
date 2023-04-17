<?php
/*
//$fName = $uploaddir . 'shot.jpg';
//$img = new Imagick($fName);


//Приводим избражение к ширине 1280px
$img->resizeImage(1280,0, Imagick::FILTER_UNDEFINED,1);//1280*591
file_put_contents($uploadfile, $img);//Замена файла приведенным к размерам изображением

$link = "/public/uploads/". $fName;
echo "<img src=\"$link\" width=\"100%\"><br/><br/>";


*/
//$imgTemp = new Imagick($fName); 
$img = new Imagick(__DIR__  . '/public/uploads/Screenshot.jpg');//shot



 //blackThresholdImage()//Перевести все пиксели ниже порогового значения в чёрный цвет
    $img->blackThresholdImage( "#777777" );
    $img->whiteThresholdImage( "#777777" );
//$imgTemp = $img->clone();


/*$size = $img->getImageGeometry();// return arr - ['width']=>1280,["height"]=>597
// $img->getImageSize();// размер в байтах
//var_dump($size);echo "<br/>";
$pixel = $img->getImagePixelColor(210,170);
$color =$pixel->getColor();//{ ["r"]=> int(179) ["g"]=> int(198) ["b"]=> int(204) ["a"]=> int(1) }
//$color =$pixel->getHSL();//{ ["hue"]=> float(0.54) ["saturation"]=> float(0.19685039370079) ["luminosity"]=> float(0.75098039215686) }
                                //оттенок, насыщеность, освещенность

//var_dump($color);echo "<br/>";
$pixel->setColor('red');

*/
// Если в качестве ширины или высоты передан 0,
// то сохраняется соотношение сторон
//$imgTemp->cropImage(583,318,235,168);//окно с резами при разрешении 1280/591
    //ширина, высота, х-колонки, у - строки


//208->235 >>+27
//$img->thumbnailImage(1000, 0);
//$imgTemp->cropImage(583,46,235,168);//первая строка с резом игрока и с позицией в начале

/*
$players = ['Bison.jpg','narinski.jpg','shuraken.jpg','Далай.jpg','артем.jpg'];
                
$hArr = [170,217,263,309,355,401,447];
for($n=0;$n<7;$n++)
{
    $find = 0;
    $imgTemp = new Imagick($uploadfile); 
    $imgTemp->cropImage(262,43,388,$hArr[$n]+1);
    $num = $n+1;
    echo "Строка $num: ";
    $min_res = 100;
    $player = 'Не найден';
    for($i=0;$i<count($players);$i++)
    {
        $sample = new \Imagick($uploaddir . $players[$i]);
        
        //echo "- $players[$i] ? - Distortion = $result";
        //echo "<br/>";
        if($result < $min_res)
        {
            $min_res = $result;
            $player = $players[$i];
        }
        
        /*if($result < 1){
                $find = 1;
                echo $players[$i];
                continue;
                }*/
                
                /*
        $sample->clear();
    }
    if ($min_res >10){echo 'Не найден';}else {echo $player;}
    echo " - $min_res";
    echo "<br/><br/>"; 
    //if($find>0){echo 'Нашел!!!';}
    $imgTemp->clear();
}

}else print_r('Вы не отправили файл!');
*/




//$hArr = [170,217,263,309,355,401,447];
//[172,219,265,312,359,405,452];-redmi 8
//[162,207,252,298,343,388,433];-redmi 11
    //        $imgTemp->cropImage(262,43,374,252);////ник ирока от угла флага 
    //$imgTemp->cropImage(250,41,374,208);





/*
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
   echo "row - ". $row . " - distortion = " . $distortion . "<br/>";
   if($distortion < 60) $widthOfWhite ++;//Если в строке много светлого делаем +1 к светлым строкам
   if($widthOfWhite == 3)//Если подряд идет три не черных строки
   {
       $arrUpHeights[] = $row - 2; //записываем в массив номер строки с верхом строки игрока
       echo "начало строки игрока = " . ($row - 2);echo "<br/>";
   }
   if($widthOfWhite > 30 && $distortion > 59) //Если высота поля строк не черного цвета и появляется черная полоса
   {
       $heightOfRow[] = $widthOfWhite; //считаем, что это был конец поля игрока и записываем высоту поля игрока в массив
       echo "Высота строки игрока = $widthOfWhite<br/>";
       $widthOfWhite = 0;// обнуляем подсчет белых строк
   }
   
   
   $line->clear();// очищаем обЪект строки пикселей
   
}
//file_put_contents(__DIR__ . '/public/players_img/' . 'shuraken.jpg', $imgTemp);
*/


//Если изменять высоту начальной точки +- 3px , и выбирать наименьшее значение $result
//можно проверять смещение таким образом
// правда, увеличится время поиска из-за того, что нужно перебирать всех игроков каждый раз
//$imgTemp->cropImage(265,46,363,170);//ник
//$imgTemp->cropImage(265,46,363,169);//ник

 /* $result = $img->getImageDistortion($imgTemp, Imagick::METRIC_MEANSQUAREERROR);
 echo $result*100;
 
 $result = $img->compareImages($imgTemp, Imagick::METRIC_MEANSQUAREERROR);
 
    $result[0]->setImageFormat("jpg");
    header("Content-Type: image/jpg");
    echo $result;
  
   
    // echo $result[1]*100;
 */

  /* */
  header('Content-type: image/jpeg');

echo $img;  

//var_dump($img->getImageBackgroundColor()->getColor());

//$color =$pixel->getColor();
//var_dump($imgTemp);
//echo $imgTemp;
//var_dump($img->getImageGeometry());// рзмер в писелях в виде массива
