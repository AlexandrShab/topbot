<?php
//var_dump($_FILES);
$players_img_dir = __DIR__ . '/public/players_img/';
$uploaddir = __DIR__ . '/public/uploads/';
$fName= 'Scrin.jpg';
$uploadfile = $uploaddir . $fName; 
if(isset($_FILES['screenshot']))
{
    $fName = basename($_FILES['screenshot']['name']);
  


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

//$fName = $uploaddir . 'shot.jpg';
//$img = new Imagick($fName);

$img = new Imagick($uploadfile);

//Приводим избражение к ширине 1280px
$img->resizeImage(1280,0, Imagick::FILTER_UNDEFINED,1);//1280*591
file_put_contents($uploadfile, $img);//Замена файла приведенным к размерам изображением

$link = "/public/uploads/". $fName;
echo "<img src=\"$link\" width=\"100%\"><br/><br/>";



//$imgTemp = new Imagick($fName); 

$imgTemp = $img->clone();
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


$players = ['Bison.jpg','narinski.jpg','shuraken.jpg','Далай.jpg','артем.jpg','Vlad.jpg', 'Гена.jpg','Ka4egar.jpg','Bafon.jpg'];
                
//$hArr = [170,217,263,309,355,401,447];//redmi 8
$hArr = [162,207,265,298,343,388,433];//redmi 11
for($n=0;$n<7;$n++)
{
    $find = 0;
    $imgTmp = new Imagick($uploadfile); 
    $imgTmp->cropImage(262,43,388,$hArr[$n]);
    $num = $n+1;
    echo "Строка $num: ";
    $min_res = 100;
    $player = 'Не найден';
    for($i=0;$i<count($players);$i++)
    {
        $sample = new \Imagick($players_img_dir . $players[$i]);
        $result = $imgTemp->getImageDistortion($sample, Imagick::METRIC_MEANSQUAREERROR)*100;
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
        $sample->clear();
    }
    if ($min_res >10){echo 'Не найден';}else {echo $player;}
    echo " - $min_res";
    echo "<br/><br/>"; 
    //if($find>0){echo 'Нашел!!!';}
    $imgTemp->clear();
}

}else print_r('Вы не отправили файл!');
/*
$imgTemp->cropImage(262,43,388,170);////ник ирока от угла флага
//file_put_contents($players_img_dir . 'Bison.jpg', $imgTemp);
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
 //blackThresholdImage()//Перевести все пиксели ниже порогового значения в чёрный цвет
 /*
    $img->blackThresholdImage( "#909090" );
    $img->whiteThresholdImage( "#303030" );
  
  header('Content-type: image/jpeg');

//echo $img;  

//var_dump($img->getImageBackgroundColor()->getColor());

//$color =$pixel->getColor();
//var_dump($imgTemp);
echo $imgTemp;
//var_dump($img->getImageGeometry());// рзмер в писелях в виде массива
*/
