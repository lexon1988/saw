<?php

if($_POST['banner1']<>""){
	
	file_put_contents("../banners/1.txt",$_POST['banner1']);
	file_put_contents("../banners/2.txt",$_POST['banner2']);
	file_put_contents("../banners/3.txt",$_POST['banner3']);	

	header("Location: banners.php");
}


//includes-----------------
include('../classes/class.php');
//-------------------------
$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Баннеры","","","utf-8");
$headerr->admin_bar();

$banner1=file_get_contents("../banners/1.txt");
$banner2=file_get_contents("../banners/2.txt");
$banner3=file_get_contents("../banners/3.txt");

echo "<div class='content container'>";

echo "

<form action='banners.php' method='post'>

Левый баннер
<br>
<textarea cols='40' rows='5' name='banner1'>".$banner1."</textarea>
<br><br>

Средний баннер
<br>
<textarea cols='40' rows='5' name='banner2'>".$banner2."</textarea>
<br><br>

Правый баннер
<br>
<textarea cols='40' rows='5' name='banner3'>".$banner3."</textarea>
<br>

<hr>
<input type='submit' value='Отправить'>

</form> 







";



echo "</div>";

$headerr->footerr();



?>