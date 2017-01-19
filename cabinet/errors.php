<?php

include('../classes/class.php');
$headerr=new Headerr();

$url= "http://".$_SERVER['SERVER_NAME'];
		

$err=$_GET['err'];

if($err==1){
	
	echo "Вы не авторизованы!!!!";
	$headerr->redirect_to($url,3000);
}



if($err==2){
	
	echo "
	
	<div class='content Scontainer'>
		<br /><br />
	
		<div align='center' style='margin-left: 25%; width:500px; margin-top: 300px; border: 1px solid lightgrey; padding: 20px 50px 20px 50px;'>
	
	Извините, но ваша учётная запись заблокированна!<br />
	Теперь вы можете посещать наш сайт, только как гость.Выйти из учётной записи можно <a href='../logout.php'>тут</a>!
	
		</div>
	</div>	
	
	";
	
}







?>