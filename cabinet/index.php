<?php



include('../classes/class.php');

$headerr=new Headerr();

$headerr->redirect_to("../index.php",1000);


$db=new Database();

$headerr->headerrs("Кабинет","","","utf-8");
include('noauth.php');

$headerr->user_bar();

//не удалять!
$user_id=$_COOKIE['id'];
if(!is_dir("../uploads/".$user_id)) mkdir("../uploads/".$user_id);
	



echo "


<div class='content Scontainer'>
<div class='uc_bor'>
<p class='success_text'>
Авторизация прошла успешно!<br /><br />
Сейчас Вы будете перенаправлены на главную страницу...
</p>
</div>
</div>
";



$headerr->footerr();


?>