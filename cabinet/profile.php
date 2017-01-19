<?php

include('../classes/class.php');



$headerr=new Headerr();

$db=new Database();









$headerr->headerrs("Профиль","","","utf-8");

include('noauth.php');



$headerr->user_bar();





$url= "http://".$_SERVER['SERVER_NAME'];





$email= trim($headerr->user);

$arr_db= $db->db_select("user","WHERE email='$email'");





$user_id=$_COOKIE['id'];

if(!is_dir("../uploads/".$user_id)) mkdir("../uploads/".$user_id);

	





$region=$db->get_region_by_id($arr_db[0]['region']);

$city=$db->get_region_by_id($arr_db[0]['city']);





echo "

<div class='content Scontainer'>



  <div class='user_block'>

  <h3>Настройки Личного кабинета</h3>
  <table>
  <tr><td width='60%'>
  ";



if($_GET['rez']<>""){

	

	echo "<b><font class='success_st1'>".$_GET['rez']."</b></font><hr><br>";

	

}



if($_GET['pass']<>""){

	

	echo "<b><font class='success_st1'>".$_GET['pass']."</b></font><hr><br>";

	

}





echo "



	<hr>

<form action='profile.php' method='post'>





	<p class='ht_style'>Имя</p>: 

	<p class='in_style'>".$arr_db[0]['name']."</p>

	<br>

	<p class='ht_style'>E-mail</p>:

	<p class='in_style'>".$arr_db[0]['email']."</p>

	<br>

	<hr>

";

	

	

	

	if($arr_db[0]['mail_status']==0){

	

		echo "<a href='profile.php?mail_status=1'>Запретить уведомления по почте</a>";

	

	}else{



		echo "<a href='profile.php?mail_status=2'>Разрешить уведомления по почте</a>";

	

	}

	

echo "	

	<hr>

	<font class='warning_st1'>Изменить имя или почту можно только через службу поддержки</font> - <font class='info_st1'><a href='".$url."/cabinet/massages.php?to=000&ads=000'>написать в службу поддержки</a></font>

		<hr>



	<b>Сменить пароль</b>

	<br>

	<input class='input_st1' type='text' size='10' name='pass' value=''>

	

	<br />

	

	<input class='submit_st1' type='submit' value='Сменить пароль'>

	</form>

	

	

	<form action='profile.php' method='post'> 

	<hr>

	

	<font class='info_st1'>Регион который будет указан в ваших объявлениях: <strong>".$region."/ ".$city."</strong> </font><br />

	<font class='warning_st1'>(можно сменить при необходимости)</font>

	<hr>

	<b>Укажите другой регион и нажимте на кнопку \"Отправить\"</b><br><br>

	

	";	

	

	

	

	include('../tools/region/reg/index.php');

	

echo "	

	

<input  class='submit_st1'  type='submit' value='Отправить'>

</form>



<hr>
</td>
<td width='40%'>
</td>
</tr>
</table>

</div></div>

";









if($_POST['region']<>""){



$region=$_POST['region'];

$city=$_POST['city'];



$db->db_update("user","SET region='$region', city='$city' WHERE email='$email'");



$headerr->redirect_to("profile.php?rez=Регион изменён!",0);



}





if($_POST['pass']<>""){

	

	$new_pass=$_POST['pass'];

	$user_id=$_COOKIE['id'];

	

	$db->db_update("user","set pass='$new_pass' WHERE id='$user_id'" );



	$headerr->redirect_to("profile.php?pass=Пароль изменён!",0);

	

}







if($_GET['mail_status']==1){

	

	

	$db->db_update("user","SET mail_status='1' WHERE email='$email'");

	$headerr->redirect_to("profile.php",0);

}



if($_GET['mail_status']==2){

		

	

	$db->db_update("user","SET mail_status='0' WHERE email='$email'");

	$headerr->redirect_to("profile.php",0);

}













$headerr->footerr();





?>
