<?php
include('../classes/class.php');

$headerr=new Headerr();
$db=new Database();

$headerr->headerrs("Мои объявления","","","utf-8");
$headerr->admin_bar();

$user_id=$_COOKIE['id'];


$ads=$db->db_select("ads","WHERE status=0");
$ads_count=count($ads);


echo "

<div class='content container'>
<br /><br />
<a href='ads_my.php'>Новые</a>

|

<a href='ads_good.php'>Одобренные</a>

|

<a href='ads_bad.php'>Отклонённые</a>

";


echo "<hr>";


echo "<table class='table table-bordered'>";

echo "<tr>
	
		<th>№</th>
		<th>Автор</th>
		<th>Тип объявления</th>
		<th>Категории</th>		

		<th>Текст объявления</th>	
		<th>Статус</th>
		<th></th>
		<th></th>
	</tr>";



for($i=0;$i<$ads_count; $i++){
	
	
	if($ads[$i]['type']==0){
		
		$type='Товар';	
	
	}else{
		
		$type='Услуга';	
	}
	
	if($ads[$i]['status']==0){
		
		$status='<font color=red>Ожидает модерации</font>';
		
	}
	
	if($ads[$i]['status']==1){
		
		$status='<font color=red>Приостановлено</font>';
		
	}
	
	
	if($ads[$i]['status']==2){
		
		$status='<font color=red>Обобренно</font>';
		
	}
	
	
	if($ads[$i]['status']==3){
		
		$status='<font color=red>Отклонено</font>';
		
	}
	
	
	
	
	echo "<tr>
	
		<td>".($i+1)."</td>
		<td>".$db->get_user_by_id($ads[$i]['author'])." [".$ads[$i]['author']."]</td>
		<td>".$type."</td>
		<td><small>".$db->get_cat_by_id($ads[$i]['cat1'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat2'])."<b> > </b>	
		".$db->get_cat_by_id($ads[$i]['cat3'])."</small></td>	
		<td>".$ads[$i]['text']."</td>
		<td>".$status."</td>	
		<td><a href='ads_my.php?good=".$ads[$i]['id']."&author=".$ads[$i]['author']."'>Одобрить</a></td>	
		<td>
		

		<a href='ads_my.php?bad=".$ads[$i]['id']."'>Отклонить</a>
		

		</td>	
	</tr>
	<tr>
	
	<td colspan=8 style='background-color: #D6FFF9;  padding:10px;'>
	<small>
	
	";
	
	if($ads[$i]['files']<>""){
	
		$db->get_files("../uploads/".$ads[$i]['author']."/".$ads[$i]['files']."/","");
	
	}
	
	
	echo "
	</small>
	</td>
	
	
	</tr>
	
	
	";



	
}

echo "</table>";

/*УДАЛИТЬ
if($_GET['id']<>"" ){
	
	$del_id=$_GET['id'];
	$db->db_delete("ads","WHERE id='$del_id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}

*/


	

if($_GET['good']<>"" ){
	
	
	
	$email=$db->get_email_by_id($_GET['author']);
	
	
	include "../classes/mailer/libmail.php"; // вставляем файл с классом
	//$m= new Mail; // начинаем 
	$m= new Mail('utf-8'); 
	$m->From( "hello@saawok.com" ); // от кого отправляется почта 
	$m->To( $email ); // кому адресованно
	$m->Subject( "Ваше объявление одобренно!" );
	$m->Body( "Здравствуйте, Ваше объявление одобренно!");    
	$m->Bcc( "info@saawok.com"); // скрытая копия отправится по этому адресу
	$m->Priority(3) ;    // приоритет письма
	//$m->Attach( "asd.gif","", "image/gif" ) ; // прикрепленный файл 
	$m->smtp_on( "ssl://smtp.yandex.ru", "hello@saawok.com", "K0!kj-Qj1%n1Z3", 465) ; // если указана эта команда, отправка пойдет через SMTP 
	$m->Send();    // а теперь пошла отправка
	$m->log_on(true);

	
	
	
	$id=$_GET['good'];
	$db->db_update("ads","set status='2' WHERE id='$id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}

if($_GET['bad']<>"" ){
	
	$id=$_GET['bad'];
	$db->db_update("ads","set status='3' WHERE id='$id'");
	$headerr->redirect_to("ads_my.php",1000);
	
}

echo "</div>";

$headerr->footerr();


?>
