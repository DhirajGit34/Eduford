<?php
header('content-type:image/jpeg');
$font="BRUSHSCI.TTF";
$image=imagecreatefromjpeg("certificate.jpg");
$color=imagecolorallocate($image,19,21,22);
$name="Dhiraj Deka";
imagettftext($image,90,0,740,780,$color,$font,$name);
// $date="6th may 2020";
// imagettftext($image,20,0,450,595,$color,"AGENCYR.TTF",$date);
imagejpeg($image);
imagedestroy($image);
?>