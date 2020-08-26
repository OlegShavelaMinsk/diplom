<?php 
 
ini_set('display_errors','Off');

//Запускаем сессию

header("Content-type: image/png");
error_reporting(0);
//Создаем Основу для изображения
$imd=imagecreatetruecolor(250,100);
$white = imagecolorallocate($imd,rand(220,255),rand(220,255),rand(220,255));
imagefill($imd,0,0,$white);
$code='';
$symbols='abcdefghijklmnopqrstuwxyz1234567890';
$col = rand(4,6);
//Рисуем царапины
$crack_num = rand(80,160);
for($i=0;$i<$crack_num;$i++) {
        $crack_length = rand(100,160);
        $color = imagecolorallocate($imd,rand(180,200),rand(180,200),rand(180,200));
        $point_x = rand(0,250);
        $point_y = rand(0,100);
        for($j=0;$j<$crack_length;$j++) {
                imagesetpixel($imd,$point_x,$point_y,$color);
                if(rand(0,1)) $point_x += 1; else $point_x -= 1;
                if(rand(0,1)) $point_y += 1; else $point_y -= 1;
        }
}
//Сглаживаем
$img = imagecreatetruecolor(175,50);
imagecopyresampled($img,$imd,0,0,0,0,175,50,250,100);
imagedestroy($imd);
//Наносим текст
for($i=0;$i<$col;$i++) {
        //Варьируем цвет
        $color = imagecolorallocate($img,rand(0,125),rand(0,125),rand(0,125));
        $shadow = imagecolorallocatealpha($img,0,0,0,rand(90,120));
        //Выбираем символ из набора
        $symbol = $symbols[rand(0,strlen($symbols)-1)];
        $code.=$symbol;
        //Рисуем текст
        $pos_x = 45-$col*6 + $i*30 + rand(-2,2);
        $pos_y = rand(37,42);
        $angle = rand(-15,15);
        $size = rand(24,26);
        $font = dirname(__FILE__).'/captcha.ttf';
        //Делаем тень
        $disp_x=rand(3,5);
        $disp_y=rand(3,5);
        if(rand(0,1)) $disp_x = -$disp_x;
        if(rand(0,1)) $disp_y = -$disp_y;
        imagettftext($img, $size, $angle, $pos_x+$disp_x, $pos_y+$disp_y, $shadow, $font, $symbol);
        //Текст
        imagettftext($img, $size, $angle, $pos_x, $pos_y, $color, $font, $symbol);
 
}
//Записываем результат в сессию
if(!@count($_SESSION)) session_start();
$_SESSION['CAPTCHA'] = $code;
//Выводим изображение
imagepng($img);
imagedestroy($img);

?>